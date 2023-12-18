@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bannerCard.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banner-cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerCard.fields.id') }}
                        </th>
                        <td>
                            {{ $bannerCard->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerCard.fields.title') }}
                        </th>
                        <td>
                            {{ $bannerCard->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerCard.fields.description') }}
                        </th>
                        <td>
                            {{ $bannerCard->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerCard.fields.image') }}
                        </th>
                        <td>
                            @if($bannerCard->image)
                                <a href="{{ $bannerCard->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $bannerCard->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerCard.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\BannerCard::STATUS_RADIO[$bannerCard->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banner-cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection