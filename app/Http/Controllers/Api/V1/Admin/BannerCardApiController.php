<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBannerCardRequest;
use App\Http\Requests\UpdateBannerCardRequest;
use App\Http\Resources\Admin\BannerCardResource;
use App\Models\BannerCard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannerCardApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banner_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BannerCardResource(BannerCard::all());
    }

    public function store(StoreBannerCardRequest $request)
    {
        $bannerCard = BannerCard::create($request->all());

        if ($request->input('image', false)) {
            $bannerCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new BannerCardResource($bannerCard))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BannerCard $bannerCard)
    {
        abort_if(Gate::denies('banner_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BannerCardResource($bannerCard);
    }

    public function update(UpdateBannerCardRequest $request, BannerCard $bannerCard)
    {
        $bannerCard->update($request->all());

        if ($request->input('image', false)) {
            if (! $bannerCard->image || $request->input('image') !== $bannerCard->image->file_name) {
                if ($bannerCard->image) {
                    $bannerCard->image->delete();
                }
                $bannerCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($bannerCard->image) {
            $bannerCard->image->delete();
        }

        return (new BannerCardResource($bannerCard))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BannerCard $bannerCard)
    {
        abort_if(Gate::denies('banner_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerCard->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
