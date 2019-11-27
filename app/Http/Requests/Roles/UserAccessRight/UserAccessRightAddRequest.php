<?php

namespace App\Http\Requests\Roles\UserAccessRight;

use Illuminate\Foundation\Http\FormRequest;

class UserAccessRightAddRequest extends FormRequest
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
            'user_access_right_name'  => 'required | unique:user_access_rights',
        ];
    }
}
