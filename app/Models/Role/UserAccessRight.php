<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;

class UserAccessRight extends Model
{
    protected $table ='user_access_rights';
    protected $casts = [
        'activated' => 'integer'
    ];
    protected $fillable = [
        'activated', 'user_access_right_name', 'user_access_right_description'
    ];
}
