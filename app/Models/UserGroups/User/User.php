<?php

namespace App\Models\UserGroup\User;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'full_name', 'email', 'password',
        'company_name', 'contact', 'salt_value', 'team_id', 'firebase_id',
        'user_group_id', 'profile_image', 'sbst_sign','remarks', 'account_status', 'password_changed',
        'sbst_changed', 'blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Find the user identified by the given $identifier.
     *
     * @param $identifier email|phone
     * @return mixed
     */
    public function findForPassport($identifier)
    {
        return User::orWhere('email', $identifier)
                   ->orWhere('username', $identifier)
                   ->orWhere('contact', $identifier)
                   ->first();
    }

    public function team()
    {
        return $this->belongsTo(\App\Models\UserGroups\Team\Team::class);
    }

    public function user_group()
    {
        return $this->belongsTo(\App\Models\UserGroups\UserGroup\UserGroup::class);
    }
}
