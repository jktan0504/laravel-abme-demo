<?php

namespace App\Models\Reports\FaultCallService;

use Illuminate\Database\Eloquent\Model;

class FaultCallService extends Model
{
    protected $table ='fault_call_services';

    protected $casts = [
        // 'activated' => 'integer',
    ];

    protected $fillable = [
        'report_no', 'station_id', 'user_id',
        'contact_person', 'contact_person_no', 'fault_call_receive_date',
        'fault_call_receive_time', 'arrival_date', 'arrival_time',
        'fault_alarm_inspection_desc', 'fault_alarm_inspection_desc2', 'fault_alarm_inspection_desc3', 'fault_alarm_inspection_desc4', 'fault_alarm_inspection_desc5','fault_alarm_inspection_reason', 'fi_action_taken_outcome_desc',
        'fault_alarm_desc', 'fault_alarm_reason', 'fr_action_taken_outcome_desc',
        'fault_alarm_inspection_completion_date', 'fault_alarm_inspection_completion_time', 'remarks',
        'pic_1', 'pic_2', 'pic_3',
        'pic_4', 'pic_5', 'inspection_conducted_by_name',
        'inspection_conducted_by_signature', 'witness_by_abme_name', 'witness_by_abme_signature',
        'witness_by_sbst_user_id',
        'witness_by_sbst_name', 'witness_by_sbst_signature', 'status', 'arrived_station',
        'acknowledge_by', 'created_by', 'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\UserGroup\User\User::class);
    }

    public function station()
    {
        return $this->belongsTo(\App\Models\Station\Station::class);
    }
}
