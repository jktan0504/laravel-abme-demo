<?php

namespace App\Http\Requests\Stations\Floor;

use Illuminate\Foundation\Http\FormRequest;

class FloorAddRequest extends FormRequest
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
            'floor_name'  => 'required',
        ];
    }
}
