<?php

namespace App\Http\Controllers\API\MailBox\MailBoxList;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Mails\MailList;
use App\Http\Resources\MailBox\MailBoxListResource;
use App\Http\Requests\MailBox\MailBoxList\MailBoxListAddRequest;

class MailBoxListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        if ($request->input('mail_group_id')) {
            $mail_group_id = $request->input('mail_group_id');

            $mail_list =  MailList::where('mail_group_id', $mail_group_id)
                    ->orderBy('id','asc')
                    ->paginate($per_page);
        }
        else {
            $mail_list = MailList::paginate($per_page);
        }

        return MailBoxListResource::collection($mail_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailBoxListAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $mail_list = new MailList;
            $mail_list->mail_group_id = $request->input('mail_group_id');

            $mail_list->mail_email = $request->input('mail_email');

            if($request->input('owner_name')){
                $mail_list->owner_name = $request->input('owner_name');
            }

            if($request->input('remarks')){
                $mail_list->remarks = $request->input('remarks');
            }

            $mail_list->created_by = $user_id;
            $mail_list->save();

            return response()->json(['success' => $mail_list], Response::HTTP_CREATED);
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
        return new MailBoxListResource(MailList::findOrFail($id));
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

        $mail_list = MailList::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $mail_list->$attribute = $credentials[$attribute];
            }

            $mail_list->updated_by = $user_id;
            $mail_list->save();

            return response()->json(['updated' => $mail_list], Response::HTTP_CREATED);
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
        $mail_list = MailList::findOrFail($id);
        $mail_list->delete();

        return response()->json(['deleted' => $mail_list], Response::HTTP_CREATED);
    }
}
