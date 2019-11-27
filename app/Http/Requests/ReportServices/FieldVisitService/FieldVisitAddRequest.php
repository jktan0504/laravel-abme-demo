<?php

namespace App\Http\Requests\ReportServices\FieldVisitService;

use Illuminate\Foundation\Http\FormRequest;

class FieldVisitAddRequest extends FormRequest
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
            'submit_date' => 'required',
            'submit_to' => 'required',
            'submit_date' => 'required',
            'visiting_date' => 'required',
            'visiting_time' => 'required',
            'submit_date' => 'required',
            //'field_visit_category_id' => 'required',
            'report_by_name_1' => 'required',
            'report_by_name_1_signature' => 'required',
        ];
    }
}
