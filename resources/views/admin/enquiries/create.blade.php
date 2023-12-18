@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.enquiry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.enquiries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.enquiry.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile">{{ trans('cruds.enquiry.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}" required>
                @if($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.enquiry.fields.enquiry_type') }}</label>
                <select class="form-control {{ $errors->has('enquiry_type') ? 'is-invalid' : '' }}" name="enquiry_type" id="enquiry_type" required>
                    <option value disabled {{ old('enquiry_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Enquiry::ENQUIRY_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('enquiry_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('enquiry_type'))
                    <span class="text-danger">{{ $errors->first('enquiry_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.enquiry_type_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('whatsapp_update') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="whatsapp_update" value="0">
                    <input class="form-check-input" type="checkbox" name="whatsapp_update" id="whatsapp_update" value="1" {{ old('whatsapp_update', 0) == 1 || old('whatsapp_update') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="whatsapp_update">{{ trans('cruds.enquiry.fields.whatsapp_update') }}</label>
                </div>
                @if($errors->has('whatsapp_update'))
                    <span class="text-danger">{{ $errors->first('whatsapp_update') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.whatsapp_update_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('privacy') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="privacy" value="0">
                    <input class="form-check-input" type="checkbox" name="privacy" id="privacy" value="1" {{ old('privacy', 0) == 1 || old('privacy') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="privacy">{{ trans('cruds.enquiry.fields.privacy') }}</label>
                </div>
                @if($errors->has('privacy'))
                    <span class="text-danger">{{ $errors->first('privacy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.enquiry.fields.privacy_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection