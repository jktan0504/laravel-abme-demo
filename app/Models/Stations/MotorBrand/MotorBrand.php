<?php

namespace App\Models\Stations\MotorBrand;

use Illuminate\Database\Eloquent\Model;

class MotorBrand extends Model
{
    protected $table ='motor_brands';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'motor_brand_name', 'motor_brand_description', 'activated', 'created_by', 'updated_by'
    ];
}
