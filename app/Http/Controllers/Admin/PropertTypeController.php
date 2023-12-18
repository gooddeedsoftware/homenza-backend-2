<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPropertTypeRequest;
use App\Http\Requests\StorePropertTypeRequest;
use App\Http\Requests\UpdatePropertTypeRequest;
use App\Models\PropertType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('propert_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertTypes = PropertType::all();

        return view('admin.propertTypes.index', compact('propertTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('propert_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.propertTypes.create');
    }

    public function store(StorePropertTypeRequest $request)
    {
        $propertType = PropertType::create($request->all());

        return redirect()->route('admin.propert-types.index');
    }

    public function edit(PropertType $propertType)
    {
        abort_if(Gate::denies('propert_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.propertTypes.edit', compact('propertType'));
    }

    public function update(UpdatePropertTypeRequest $request, PropertType $propertType)
    {
        $propertType->update($request->all());

        return redirect()->route('admin.propert-types.index');
    }

    public function show(PropertType $propertType)
    {
        abort_if(Gate::denies('propert_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.propertTypes.show', compact('propertType'));
    }

    public function destroy(PropertType $propertType)
    {
        abort_if(Gate::denies('propert_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertType->delete();

        return back();
    }

    public function massDestroy(MassDestroyPropertTypeRequest $request)
    {
        $propertTypes = PropertType::find(request('ids'));

        foreach ($propertTypes as $propertType) {
            $propertType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
