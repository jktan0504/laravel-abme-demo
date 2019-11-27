<?php

namespace App\Http\Requests\Stations\Grease;

use Illuminate\Foundation\Http\FormRequest;

class GreaseTypeAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grease_type_name'  => 'required',
        ];
    }
}
