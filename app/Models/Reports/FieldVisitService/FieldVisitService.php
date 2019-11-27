<?php

namespace App\Models\Reports\FieldVisitService;

use Illuminate\Database\Eloquent\Model;

class FieldVisitService extends Model
{
    protected $table ='field_visit_services';

    protected $casts = [
        // 'submit_date' => 'date',
        // 'visiting_date' => 'date',
        // 'visiting_time' => 'time',
        // 'location_id' => 'string',
        'field_visit_category_id' => 'string',
        // 'report_by_name_1_date' => 'date',
        // 'report_by_name_2_date' => 'date',
        // 'report_by_name_3_date' => 'date',
    ];

    protected $fillable = [
        'submit_date', 'submit_to', 'system',
        'visiting_date', 'visiting_time', 'location_id', 'location',
        'field_visit_category_id', 'field_visit_other_category', 'details_findings',
        'summary', 'pic_1', 'pic_2',
        'pic_3', 'pic_4', 'pic_5',
        'report_by_name_1', 'report_by_name_1_date', 'report_by_name_1_signature',
        'report_by_name_2', 'report_by_name_2_date', 'report_by_name_2_signature',
        'report_by_name_3', 'report_by_name_3_date', 'report_by_name_3_signature',
        'status'
    ];
}
