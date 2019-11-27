<?php

namespace App\Models\SMS;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table ='sms';

    protected $casts = [
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'receiver_id' => 'integer',
    ];

    protected $fillable = [
        'sender_id', 'receiver_id', 'sender_number', 'receiver_number', 'message', 'remarks', 'msg_response_code',
        'commzgate_msg_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\UserGroup\User\User::class);
    }
}
