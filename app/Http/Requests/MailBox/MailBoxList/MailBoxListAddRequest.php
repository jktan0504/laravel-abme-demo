<?php

namespace App\Http\Requests\MailBox\MailBoxList;

use Illuminate\Foundation\Http\FormRequest;

class MailBoxListAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mail_group_id'  => 'required',
            'mail_email' => 'required'
        ];
    }
}
