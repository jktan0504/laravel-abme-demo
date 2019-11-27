<?php

namespace App\Http\Requests\Stations\EquipmentType;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentSubTypeAddRequest extends FormRequest
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
            'equipment_sub_type_name'  => 'required',
            'equipment_type_id'  => 'required',
        ];
    }
}
