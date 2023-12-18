@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.property.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.id') }}
                        </th>
                        <td>
                            {{ $property->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.name') }}
                        </th>
                        <td>
                            {{ $property->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.address') }}
                        </th>
                        <td>
                            {{ $property->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.landmark') }}
                        </th>
                        <td>
                            {{ $property->landmark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.country') }}
                        </th>
                        <td>
                            {{ $property->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.state') }}
                        </th>
                        <td>
                            {{ $property->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.city') }}
                        </th>
                        <td>
                            {{ $property->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.pincode') }}
                        </th>
                        <td>
                            {{ $property->pincode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.description') }}
                        </th>
                        <td>
                            {!! $property->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.property_type') }}
                        </th>
                        <td>
                            {{ $property->property_type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.amenities') }}
                        </th>
                        <td>
                            @foreach($property->amenities as $key => $amenities)
                                <span class="label label-info">{{ $amenities->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.services') }}
                        </th>
                        <td>
                            @foreach($property->services as $key => $services)
                                <span class="label label-info">{{ $services->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Property::GENDER_SELECT[$property->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.amount') }}
                        </th>
                        <td>
                            {{ $property->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.payment_remark') }}
                        </th>
                        <td>
                            {{ $property->payment_remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.latitude') }}
                        </th>
                        <td>
                            {{ $property->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.longitude') }}
                        </th>
                        <td>
                            {{ $property->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Property::STATUS_SELECT[$property->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.photos') }}
                        </th>
                        <td>
                            @foreach($property->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.youtube_link') }}
                        </th>
                        <td>
                            {{ $property->youtube_link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection