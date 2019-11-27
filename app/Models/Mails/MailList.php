<?php

namespace App\Models\Mails;

use Illuminate\Database\Eloquent\Model;

class MailList extends Model
{
    protected $table ='mail_lists';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'mail_group_id', 'mail_email', 'activated', 'owner_name', 'remarks', 'created_by', 'updated_by'
    ];
}
