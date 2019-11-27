<?php

namespace App\Models\UserGroups\Team;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table ='teams';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'team_name', 'team_description', 'activated'
    ];
}
