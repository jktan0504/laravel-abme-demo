<?php

namespace App\Http\Requests\Roles\UserHasAccessRight;

use Illuminate\Foundation\Http\FormRequest;

class UserHasAccessRightRequest extends FormRequest
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
            'user_group_id'  => 'required',
            'user_access_right_id'  => 'required',
        ];
    }
}
