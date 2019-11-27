<?php

namespace App\Http\Requests\Stations\MotorBrand;

use Illuminate\Foundation\Http\FormRequest;

class MotorBrandAddRequest extends FormRequest
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
            'motor_brand_name'  => 'required',
        ];
    }
}
