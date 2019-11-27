<?php

namespace App\Models\Stations;

// NOT USING THIS ==> STATION

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table ='stations';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'station_no', 'station_name', 'floor_id', 'equipment_type_id',
        'equipment_sub_type_id', 'cd_noncd_flag', 'equipment_descriptions', 'location', 'location_id', 'brand_id', 'model', 'series', 'motor_brand_id', 'motor_model', 'motor_serial', 'motor_kw', 'belt_size', 'grease_type_id', 'panel_type_id', 'ecs_control_room_location', 'remarks',
        'activated', 'created_by', 'updated_by'
    ];
}
