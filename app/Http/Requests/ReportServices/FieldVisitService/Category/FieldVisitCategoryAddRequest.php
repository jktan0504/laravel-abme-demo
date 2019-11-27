<?php

namespace App\Http\Requests\ReportServices\FieldVisitService\Category;

use Illuminate\Foundation\Http\FormRequest;

class FieldVisitCategoryAddRequest extends FormRequest
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
            'category_name'  => 'required',
        ];
    }
}
