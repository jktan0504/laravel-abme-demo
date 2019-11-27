<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table ='notifications';

    protected $casts = [
    ];


    protected $fillable = [
        'id', 'type', 'notifiable', 'data', 'read_at', 'created_at', 'updated_at'
    ];
}
