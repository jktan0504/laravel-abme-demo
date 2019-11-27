<?php

namespace App\Models\Stations\EquipmentType;

use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    protected $table ='equipment_types';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'equipment_type_name', 'equipment_type_description', 'activated', 'created_by', 'updated_by'
    ];
}
