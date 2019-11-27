<?php

namespace App\Models\Station;

//  USING THIS AS STATION

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table ='station';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'station_no', 'station_name', 'remarks', 'status',
        'activated',
        'activated', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
