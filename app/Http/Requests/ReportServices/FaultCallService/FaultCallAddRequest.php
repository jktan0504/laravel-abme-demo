<?php

namespace App\Http\Requests\ReportServices\FaultCallService;

use Illuminate\Foundation\Http\FormRequest;

class FaultCallAddRequest extends FormRequest
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
            // 'station_id' => 'required',
            // 'contact_person' => 'required',
            // 'contact_person_no' => 'required',
            // 'fault_call_receive_date' => 'required',
            // 'fault_call_receive_time' => 'required',
            // 'arrival_date' => 'required',
            // 'arrival_time' => 'required',
            // 'fault_alarm_inspection_desc' => 'required',
            // 'fault_alarm_inspection_reason' => 'required',
            // 'fi_action_taken_outcome_desc' => 'required',
            // 'fault_alarm_desc' => 'required',
            // 'fault_alarm_reason' => 'required',
            // 'fr_action_taken_outcome_desc' => 'required',
            // 'fault_alarm_inspection_completion_date' => 'required',
            // 'fault_alarm_inspection_completion_time' => 'required',
        ];
    }
}
