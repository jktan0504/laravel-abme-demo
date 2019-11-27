<?php

namespace App\Http\Controllers\API\UserGroups\UserGroup;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\UserGroups\UserGroup\UserGroup;
use App\Http\Resources\UserGroups\UserGroup\UserGroupResource;
use App\Http\Requests\UserGroups\UserGroup\UserGroupAddRequest;


class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // per_page for total pagination
        $per_page_total = $request->input('per_page');
        $usergroups =  UserGroup::orderBy('id','asc')
                ->paginate($per_page_total);
        return UserGroupResource::collection($usergroups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGroupAddRequest $request)
    {
        $credentials = $request->all();
        try {
            $usergroup = new UserGroup;
            $usergroup->user_group_name = $request->input('user_group_name');

            if ($request->input('user_group_description')) {
                $usergroup->user_group_description = $request->input('user_group_description');
            }

            $usergroup->activated = 1;

            $usergroup->save();

            return response()->json(['success' => $usergroup], Response::HTTP_CREATED);
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
        return new UserGroupResource(UserGroup::findOrFail($id));
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
        $usergroup = UserGroup::findOrFail($id);
        $credentials = $request->all();
        try {

            foreach($credentials as $attribute => $prop) {
                $usergroup->$attribute = $credentials[$attribute];
            }
            $usergroup->save();

            return response()->json(['updated' => $usergroup], Response::HTTP_CREATED);
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
        $usergroup = UserGroup::findOrFail($id);
        $usergroup->delete();

        return response()->json(['deleted' => $usergroup], Response::HTTP_CREATED);
    }
}
