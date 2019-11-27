<?php

namespace App\Models\Reports\FieldVisitService;

use Illuminate\Database\Eloquent\Model;

class FieldVisitCategory extends Model
{
    protected $table ='field_visit_categories';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'category_name', 'category_description', 'activated'
    ];
}
