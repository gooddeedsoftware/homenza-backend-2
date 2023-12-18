<?php

namespace App\Http\Requests;

use App\Models\Property;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePropertyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('property_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'landmark' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'required',
            ],
            'state' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'pincode' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'amenities.*' => [
                'integer',
            ],
            'amenities' => [
                'array',
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'array',
            ],
            'amount' => [
                'required',
            ],
            'payment_remark' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'numeric',
            ],
            'longitude' => [
                'numeric',
            ],
            'photos' => [
                'array',
            ],
            'youtube_link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
