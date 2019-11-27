<?php

namespace App\Models\Stations\Floor;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table ='floors';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'floor_name', 'floor_description', 'activated', 'created_by', 'updated_by'
    ];
}
