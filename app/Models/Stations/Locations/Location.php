<?php

namespace App\Models\Stations\Locations;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table ='locations';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'location_name', 'location_description', 'activated', 'created_by', 'updated_by'
    ];
}
