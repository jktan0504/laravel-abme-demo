<?php

namespace App\Http\Resources\Sms;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\UserGroup\User\User;

class SmsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'sender' => User::findOrFail($this->convertToInt($this->checkValidData($this->sender_id))),
            'receiver' => User::findOrFail($this->convertToInt($this->checkValidData($this->receiver_id))),
            'receiver_number' => $this->receiver_number,
            'message' => $this->message,
            'remarks' => $this->remarks,
            'msg_response_code' => $this->msg_response_code,
            'commzgate_msg_id' => $this->commzgate_msg_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }

    function checkValidData($input)
    {
        if ($input === null) {
            return $input;
        }
        else if ($input == '0') {
            return $input;
        }
        else {
            return $input;
        }
    }

    function convertToInt($input) {
        return (int)$input;
    }
}
