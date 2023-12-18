<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertTypeRequest;
use App\Http\Requests\UpdatePropertTypeRequest;
use App\Http\Resources\Admin\PropertTypeResource;
use App\Models\PropertType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('propert_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertTypeResource(PropertType::all());
    }

    public function store(StorePropertTypeRequest $request)
    {
        $propertType = PropertType::create($request->all());

        return (new PropertTypeResource($propertType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PropertType $propertType)
    {
        abort_if(Gate::denies('propert_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertTypeResource($propertType);
    }

    public function update(UpdatePropertTypeRequest $request, PropertType $propertType)
    {
        $propertType->update($request->all());

        return (new PropertTypeResource($propertType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PropertType $propertType)
    {
        abort_if(Gate::denies('propert_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
