<?php

namespace App\Models\Stations\PanelType;

use Illuminate\Database\Eloquent\Model;

class PanelType extends Model
{
    protected $table ='panel_types';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'panel_type_name', 'panel_type_description', 'activated', 'created_by', 'updated_by'
    ];
}
