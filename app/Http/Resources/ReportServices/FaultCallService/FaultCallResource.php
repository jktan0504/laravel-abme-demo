<?php

namespace App\Http\Resources\ReportServices\FaultCallService;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Station\Station;
use App\Models\UserGroup\User\User;

class FaultCallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'report_no' => $this->checkValidData($this->report_no),
            'station_id' => $this->convertToInt($this->checkValidData($this->station_id)),
            'station' => Station::findOrFail($this->convertToInt($this->checkValidData($this->station_id))),
            'station_no' => $this->getStationNo($this->station_id),
            'station_name' =>$this->getStationName($this->station_id),
            'location_name' =>$this->getStationLocation($this->station_id),
            'user_id' => $this->checkValidData($this->user_id),
            'user' => User::findOrFail($this->convertToInt($this->checkValidData($this->user_id))),
            'contact_person' => $this->checkValidData($this->contact_person),
            'contact_person_no' => decrypt($this->contact_person_no),
            'fault_call_receive_date' => $this->checkValidData($this->fault_call_receive_date),
            'fault_call_receive_time' => $this->checkValidData($this->fault_call_receive_time),
            'arrival_date' => $this->checkValidData($this->arrival_date),
            'arrival_time' => $this->checkValidData($this->arrival_time),
            'fault_alarm_inspection_desc' => $this->checkValidData($this->fault_alarm_inspection_desc),
            'fault_alarm_inspection_desc2' => $this->checkValidData($this->fault_alarm_inspection_desc2),
            'fault_alarm_inspection_desc3' => $this->checkValidData($this->fault_alarm_inspection_desc3),
            'fault_alarm_inspection_desc4' => $this->checkValidData($this->fault_alarm_inspection_desc4),
            'fault_alarm_inspection_desc5' => $this->checkValidData($this->fault_alarm_inspection_desc5),
            'fault_alarm_inspection_reason' => $this->checkValidData($this->fault_alarm_inspection_reason),
            'fi_action_taken_outcome_desc' => $this->checkValidData($this->fi_action_taken_outcome_desc),
            'fault_alarm_desc' => $this->checkValidData($this->fault_alarm_desc),
            'fault_alarm_reason' => $this->checkValidData($this->fault_alarm_reason),
            'fr_action_taken_outcome_desc' => $this->checkValidData($this->fr_action_taken_outcome_desc),
            'fault_alarm_inspection_completion_date' => $this->checkValidData($this->fault_alarm_inspection_completion_date),
            'fault_alarm_inspection_completion_time' => $this->checkValidData($this->fault_alarm_inspection_completion_time),
            'remarks' => $this->checkValidData($this->remarks),
            'pic_1' => $this->checkValidData($this->pic_1),
            'pic_2' => $this->checkValidData($this->pic_2),
            'pic_3' => $this->checkValidData($this->pic_3),
            'pic_4' => $this->checkValidData($this->pic_4),
            'pic_5' => $this->checkValidData($this->pic_5),
            'inspection_conducted_by_name' => $this->checkValidData($this->inspection_conducted_by_name),
            'inspection_conducted_by_signature' => $this->checkValidData($this->inspection_conducted_by_signature),
            'witness_by_abme_name' => $this->checkValidData($this->witness_by_abme_name),
            'witness_by_abme_signature' => $this->checkValidData($this->witness_by_abme_signature),
            'witness_by_sbst_name' => $this->checkValidData($this->witness_by_sbst_name),
            'witness_by_sbst_signature' => $this->checkValidData($this->witness_by_sbst_signature),
            'witness_by_sbst_user_id' => $this->witness_by_sbst_user_id,
            'status' => $this->status,
            'arrived_station' => $this->checkValidData($this->arrived_station),
            'acknowledge_by' => $this->getAcknowledgeUser ($this->acknowledge_by),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    function checkValidData($input)
    {
        if ($input === null || $input === 'NULL') {
            return $input;
        }
        else if ($input == '0') {
            return $input;
        }
        else {
            return decrypt($input);
        }
    }

    function convertToInt($input) {
        if ((int)$input == 0) {
            $input = 1;
        }
        return (int)$input;
    }

    function getStationNo ($station_id) {
        $station = Station::findOrFail($this->convertToInt($this->checkValidData($this->station_id)));
        return $station->station_no;
    }

    function getStationName ($station_id) {
        $station = Station::findOrFail($this->convertToInt($this->checkValidData($this->station_id)));
        return $station->station_name;
    }

    function getStationLocation ($station_id) {
        $station = Station::findOrFail($this->convertToInt($this->checkValidData($this->station_id)));
        return $station->location != null ? $station->location : 'Undefined Location';
    }

    function formattedDate ($myDateTime) {
        $date = Carbon::parse($myDateTime);
        $output=$date->format('Y-m-d H:i:s');
        return $output; //  -> 2017-12-13 12:08:16
    }

    function getAcknowledgeUser ($userID) {
        if ($userID > 0 && $userID != null) {
            return User::findOrFail($userID);
        }
        else {
            return null;
        }
    }
}
