<?php

namespace App\Models\Links;

use Illuminate\Database\Eloquent\Model;

class ShortenLink extends Model
{
    protected $table ='shorten_links';

    protected $casts = [
        'id' => 'integer',
        'activated' => 'integer',
    ];

    protected $fillable = [
        'unique_code', 'actual_link', 'activated'
    ];
}
