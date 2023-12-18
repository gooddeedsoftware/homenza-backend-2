<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPropertyRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Amenity;
use App\Models\PropertType;
use App\Models\Property;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::with(['property_type', 'amenities', 'services', 'media'])->get();

        $propert_types = PropertType::get();

        $amenities = Amenity::get();

        $services = Service::get();

        return view('admin.properties.index', compact('amenities', 'propert_types', 'properties', 'services'));
    }

    public function create()
    {
        abort_if(Gate::denies('property_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property_types = PropertType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenities = Amenity::pluck('name', 'id');

        $services = Service::pluck('name', 'id');

        return view('admin.properties.create', compact('amenities', 'property_types', 'services'));
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());
        $property->amenities()->sync($request->input('amenities', []));
        $property->services()->sync($request->input('services', []));
        foreach ($request->input('photos', []) as $file) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $property->id]);
        }

        return redirect()->route('admin.properties.index');
    }

    public function edit(Property $property)
    {
        abort_if(Gate::denies('property_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property_types = PropertType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenities = Amenity::pluck('name', 'id');

        $services = Service::pluck('name', 'id');

        $property->load('property_type', 'amenities', 'services');

        return view('admin.properties.edit', compact('amenities', 'property', 'property_types', 'services'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        $property->amenities()->sync($request->input('amenities', []));
        $property->services()->sync($request->input('services', []));
        if (count($property->photos) > 0) {
            foreach ($property->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $property->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $property->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.properties.index');
    }

    public function show(Property $property)
    {
        abort_if(Gate::denies('property_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->load('property_type', 'amenities', 'services');

        return view('admin.properties.show', compact('property'));
    }

    public function destroy(Property $property)
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->delete();

        return back();
    }

    public function massDestroy(MassDestroyPropertyRequest $request)
    {
        $properties = Property::find(request('ids'));

        foreach ($properties as $property) {
            $property->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('property_create') && Gate::denies('property_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Property();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
