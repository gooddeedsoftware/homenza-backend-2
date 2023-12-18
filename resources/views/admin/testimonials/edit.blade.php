@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.testimonial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.testimonials.update", [$testimonial->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="testimonial">{{ trans('cruds.testimonial.fields.testimonial') }}</label>
                <textarea class="form-control {{ $errors->has('testimonial') ? 'is-invalid' : '' }}" name="testimonial" id="testimonial" required>{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                @if($errors->has('testimonial'))
                    <span class="text-danger">{{ $errors->first('testimonial') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.testimonial_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook_link">{{ trans('cruds.testimonial.fields.facebook_link') }}</label>
                <input class="form-control {{ $errors->has('facebook_link') ? 'is-invalid' : '' }}" type="text" name="facebook_link" id="facebook_link" value="{{ old('facebook_link', $testimonial->facebook_link) }}">
                @if($errors->has('facebook_link'))
                    <span class="text-danger">{{ $errors->first('facebook_link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.facebook_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter_link">{{ trans('cruds.testimonial.fields.twitter_link') }}</label>
                <input class="form-control {{ $errors->has('twitter_link') ? 'is-invalid' : '' }}" type="text" name="twitter_link" id="twitter_link" value="{{ old('twitter_link', $testimonial->twitter_link) }}">
                @if($errors->has('twitter_link'))
                    <span class="text-danger">{{ $errors->first('twitter_link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.twitter_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pintrest_link">{{ trans('cruds.testimonial.fields.pintrest_link') }}</label>
                <input class="form-control {{ $errors->has('pintrest_link') ? 'is-invalid' : '' }}" type="text" name="pintrest_link" id="pintrest_link" value="{{ old('pintrest_link', $testimonial->pintrest_link) }}">
                @if($errors->has('pintrest_link'))
                    <span class="text-danger">{{ $errors->first('pintrest_link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.pintrest_link_helper') }}</span>
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