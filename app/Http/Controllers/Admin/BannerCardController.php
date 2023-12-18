<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBannerCardRequest;
use App\Http\Requests\StoreBannerCardRequest;
use App\Http\Requests\UpdateBannerCardRequest;
use App\Models\BannerCard;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BannerCardController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banner_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerCards = BannerCard::with(['media'])->get();

        return view('admin.bannerCards.index', compact('bannerCards'));
    }

    public function create()
    {
        abort_if(Gate::denies('banner_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bannerCards.create');
    }

    public function store(StoreBannerCardRequest $request)
    {
        $bannerCard = BannerCard::create($request->all());

        if ($request->input('image', false)) {
            $bannerCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bannerCard->id]);
        }

        return redirect()->route('admin.banner-cards.index');
    }

    public function edit(BannerCard $bannerCard)
    {
        abort_if(Gate::denies('banner_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bannerCards.edit', compact('bannerCard'));
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

        return redirect()->route('admin.banner-cards.index');
    }

    public function show(BannerCard $bannerCard)
    {
        abort_if(Gate::denies('banner_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bannerCards.show', compact('bannerCard'));
    }

    public function destroy(BannerCard $bannerCard)
    {
        abort_if(Gate::denies('banner_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerCard->delete();

        return back();
    }

    public function massDestroy(MassDestroyBannerCardRequest $request)
    {
        $bannerCards = BannerCard::find(request('ids'));

        foreach ($bannerCards as $bannerCard) {
            $bannerCard->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('banner_card_create') && Gate::denies('banner_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BannerCard();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
