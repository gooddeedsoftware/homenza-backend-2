<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enquiry_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'mobile' => [
                'string',
                'min:0',
                'max:10',
                'required',
            ],
            'enquiry_type' => [
                'required',
            ],
        ];
    }
}
