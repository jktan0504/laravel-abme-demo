<?php

namespace App\Models\Stations\EquipmentType;

use Illuminate\Database\Eloquent\Model;

class EquipmentSubType extends Model
{
    protected $table ='equipment_sub_types';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'equipment_type_id', 'equipment_sub_type_name', 'equipment_sub_type_description', 'activated', 'created_by', 'updated_by'
    ];

    public function equipment_type()
    {
        return $this->belongsTo(\App\Models\Stations\EquipmentType\EquipmentType::class);
    }
}
