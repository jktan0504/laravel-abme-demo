<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;

class UserGroupHasAccessRight extends Model
{
    protected $table ='user_group_has_access_rights';
    protected $casts = [
        'activated' => 'integer'
    ];

    protected $fillable = [
        'user_group_id', 'user_access_right_id', 'activated'
    ];

    public function user_group()
    {
        return $this->belongsTo(\App\Models\UserGroups\UserGroup\UserGroup::class);
    }
}
