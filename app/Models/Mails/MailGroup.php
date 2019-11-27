<?php

namespace App\Models\Mails;

use Illuminate\Database\Eloquent\Model;

class MailGroup extends Model
{
    protected $table ='mail_groups';

    protected $casts = [
        'activated' => 'integer',
    ];

    protected $fillable = [
        'mail_group_name', 'mail_group_description', 'activated', 'created_by', 'updated_by'
    ];
}
