<?php

namespace App\Http\Requests;

use App\Models\PropertType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePropertTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('propert_type_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
        ];
    }
}
