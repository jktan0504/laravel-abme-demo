<?php

namespace App\Http\Requests\Stations\PanelType;

use Illuminate\Foundation\Http\FormRequest;

class PanelTypeAddRequest extends FormRequest
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
            'panel_type_name'  => 'required',
        ];
    }
}
