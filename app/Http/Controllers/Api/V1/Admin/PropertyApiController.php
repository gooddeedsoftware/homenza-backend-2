<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\Admin\PropertyResource;
use App\Models\Property;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyResource(Property::with(['property_type', 'amenities', 'services'])->get());
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());
        $property->amenities()->sync($request->input('amenities', []));
        $property->services()->sync($request->input('services', []));
        foreach ($request->input('photos', []) as $file) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        return (new PropertyResource($property))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Property $property)
    {
        abort_if(Gate::denies('property_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyResource($property->load(['property_type', 'amenities', 'services']));
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

        return (new PropertyResource($property))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Property $property)
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
