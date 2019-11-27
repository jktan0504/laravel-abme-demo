<?php

namespace App\Http\Requests\MailBox\MailBoxGroup;

use Illuminate\Foundation\Http\FormRequest;

class MailBoxGroupAddRequest extends FormRequest
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
            'mail_group_name'  => 'required',
        ];
    }
}
