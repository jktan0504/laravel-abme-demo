<?php

namespace App\Models\Stations\Grease;

use Illuminate\Database\Eloquent\Model;

class GreaseType extends Model
{
    protected $table ='grease_types';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'grease_type_name', 'grease_type_description', 'activated', 'created_by', 'updated_by'
    ];
}
