<?php

namespace App\Http\Requests;

use App\Models\BannerCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBannerCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banner_card_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'image' => [
                'required',
            ],
        ];
    }
}
