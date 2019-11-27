<?php

namespace App\Models\SMS;

use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    protected $table ='sms_settings';

    protected $casts = [
        'id' => 'integer',
        'activated' => 'integer',
    ];

    protected $fillable = [
        'sms_format', 'receiver_list', 'activated'
    ];
}
