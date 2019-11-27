<?php

namespace App\Http\Controllers\API\MailBox\MailBoxGroup;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Mails\MailGroup;
use App\Http\Resources\MailBox\MailBoxGroupResource;
use App\Http\Requests\MailBox\MailBoxGroup\MailBoxGroupAddRequest;


class MailBoxGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return MailBoxGroupResource::collection(MailGroup::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailBoxGroupAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $mail_group = new MailGroup;
            $mail_group->mail_group_name = $request->input('mail_group_name');

            if($request->input('mail_group_description')){
                $mail_group->mail_group_description = $request->input('mail_group_description');
            }
            $mail_group->created_by = $user_id;
            $mail_group->save();

            return response()->json(['success' => $mail_group], Response::HTTP_CREATED);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new MailBoxGroupResource(MailGroup::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $mail_group = MailGroup::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $mail_group->$attribute = $credentials[$attribute];
            }

            $mail_group->updated_by = $user_id;
            $mail_group->save();

            return response()->json(['updated' => $mail_group], Response::HTTP_CREATED);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mail_group = MailGroup::findOrFail($id);
        $mail_group->delete();

        return response()->json(['deleted' => $mail_group], Response::HTTP_CREATED);
    }
}
