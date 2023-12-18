@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.enquiry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.enquiries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiry.fields.id') }}
                        </th>
                        <td>
                            {{ $enquiry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiry.fields.name') }}
                        </th>
                        <td>
                            {{ $enquiry->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiry.fields.mobile') }}
                        </th>
                        <td>
                            {{ $enquiry->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiry.fields.enquiry_type') }}
                        </th>
                        <td>
                            {{ App\Models\Enquiry::ENQUIRY_TYPE_SELECT[$enquiry->enquiry_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiry.fields.whatsapp_update') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $enquiry->whatsapp_update ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiry.fields.privacy') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $enquiry->privacy ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.enquiries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection