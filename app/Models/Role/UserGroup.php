<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table ='user_groups';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'user_group_name', 'user_group_description', 'activated'
    ];
}
