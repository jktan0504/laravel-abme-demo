<?php

namespace App\Http\Resources\ReportServices\FieldVisitService;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Models\Stations\Locations\Location;
use App\Models\Reports\FieldVisitService\FieldVisitCategory;

class FieldVisitResource extends JsonResource
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
            'submit_date' => $this->checkValidData($this->submit_date),
            'submit_to' => $this->checkValidData($this->submit_to),
            'report_no' => $this->checkValidData($this->report_no),
            'system' => $this->checkValidData($this->system),
            'visiting_date' => decrypt($this->visiting_date),
            'visiting_time' => decrypt($this->visiting_time),
            'location' => $this->checkValidData($this->location),
            'location_id' => $this->convertToInt($this->checkValidData($this->location_id)),
            'location_details' => Location::findOrFail($this->convertToInt($this->checkValidData($this->location_id))),
            'field_visit_category_id' => $this->convertToInt($this->checkValidData($this->field_visit_category_id)),
            'field_visit_category' => FieldVisitCategory::findOrFail($this->convertToInt($this->checkValidData($this->field_visit_category_id))),
            'field_visit_other_category' => $this->checkValidData($this->field_visit_other_category),
            'details_findings' => $this->checkValidData($this->details_findings),
            'summary' => $this->checkValidData($this->summary),
            'pic_1' => $this->checkValidData($this->pic_1),
            'pic_2' => $this->checkValidData($this->pic_2),
            'pic_3' => $this->checkValidData($this->pic_3),
            'pic_4' => $this->checkValidData($this->pic_4),
            'pic_5' => $this->checkValidData($this->pic_5),
            'remarks' => $this->checkValidData($this->remarks),
            'report_by_name_1' => $this->checkValidData($this->report_by_name_1),
            'report_by_name_1_date' => $this->checkValidData($this->report_by_name_1_date),
            'report_by_name_1_signature' => $this->checkValidData($this->report_by_name_1_signature),
            'report_by_name_2' => $this->checkValidData($this->report_by_name_2),
            'report_by_name_2_date' => $this->checkValidData($this->report_by_name_2_date),
            'report_by_name_2_signature' => $this->checkValidData($this->report_by_name_2_signature),
            'report_by_name_3' => $this->checkValidData($this->report_by_name_3),
            'report_by_name_3_date' => $this->checkValidData($this->report_by_name_3_date),
            'report_by_name_3_signature' => $this->checkValidData($this->report_by_name_3_signature),
            'status' => $this->checkValidData($this->status),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        // return [
        //     'id' => $this->id,
        //     'submit_date' => ($this->submit_date),
        //     'submit_to' => ($this->submit_to),
        //     'report_no' => ($this->report_no),
        //     'system' => ($this->system),
        //     'visiting_date' => ($this->visiting_date),
        //     'visiting_time' => ($this->visiting_time),
        //     'location' => ($this->location),
        //     'location_id' => ($this->location_id),
        //     'field_visit_category_id' => ($this->field_visit_category_id),
        //     'field_visit_other_category' => ($this->field_visit_other_category),
        //     'details_findings' => ($this->details_findings),
        //     'pic_1' => ($this->pic_1),
        //     'pic_2' => ($this->pic_2),
        //     'pic_3' => ($this->pic_3),
        //     'pic_4' => ($this->pic_4),
        //     'pic_5' => ($this->pic_5),
        //     'remarks' => ($this->remarks),
        //     'report_by_name_1' => ($this->report_by_name_1),
        //     'report_by_name_1_date' => ($this->report_by_name_1_date),
        //     'report_by_name_1_signature' => ($this->report_by_name_1_signature),
        //     'report_by_name_2' => ($this->report_by_name_2),
        //     'report_by_name_2_date' => ($this->report_by_name_2_date),
        //     'report_by_name_2_signature' => ($this->report_by_name_2_signature),
        //     'report_by_name_3' => ($this->report_by_name_3),
        //     'report_by_name_3_date' => ($this->report_by_name_3_date),
        //     'report_by_name_3_signature' => ($this->report_by_name_3_signature),
        //     'status' => ($this->status),
        //     'created_by' => $this->created_by,
        //     'updated_by' => $this->updated_by,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ];
    }

    function checkValidData($input)
    {
        if ($input === null) {
            return null;
        }
        else if ($input == '0') {
            return null;
        }
        else {
            return decrypt($input);
        }
    }

    function convertToInt($input) {
        return (int)$input;
    }
}
