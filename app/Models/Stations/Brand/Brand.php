<?php

namespace App\Models\Stations\Brand;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table ='brands';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'brand_name', 'brand_description', 'activated', 'created_by', 'updated_by'
    ];
}
