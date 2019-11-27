<?php

namespace App\Http\Controllers\API\Roles;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\Role\UserGroup;
use App\Models\Role\UserAccessRight;
use App\Models\Role\UserGroupHasAccessRight;
use App\Http\Resources\Roles\UserHasAccessRightResource;
use App\Http\Requests\Roles\UserHasAccessRight\UserHasAccessRightAddRequest;

class UserHasAccessRightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserHasAccessRightResource::collection(UserGroupHasAccessRight::all());
    }

     /**
     * Display a all user group with access right of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUserGroupsWithAccessRigths()
    {
        $allUserGroupHasAccessRight = UserGroupHasAccessRight::with('user_group')->get();
        $allAccessRight = UserAccessRight::all();
        $dataArray = [];

        foreach ($allUserGroupHasAccessRight as $user_has_access_right) { 
            $user_group_has_access_right_array['user_group'] = $user_has_access_right;
            foreach ($allAccessRight as $user_access_right) {
                $user_group_has_access_right_array[$user_access_right->user_access_right_id.'_checked'] = $this->checkIsAllowedAccess($user_has_access_right->user_access_rights, $user_access_right->id);
                $user_group_has_access_right_array[$user_access_right->user_access_right_id]['id'] = $user_access_right->id;
                $user_group_has_access_right_array[$user_access_right->user_access_right_id]['acccessed'] = $this->checkIsAllowedAccess($user_has_access_right->user_access_rights, $user_access_right->id);
                if ($user_group_has_access_right_array[$user_access_right->user_access_right_id]['acccessed'] == true) {
                    $user_group_has_access_right_array[$user_access_right->user_access_right_id]['checked'] = $user_access_right->id;
                }
                else {
                    $user_group_has_access_right_array[$user_access_right->user_access_right_id]['checked'] = 0;
                }

                $user_group_has_access_right_array[$user_access_right->user_access_right_id]['selectedarray']= array_map('intval', explode(',', $user_has_access_right->user_access_rights));
            }
            $user_group_has_access_right_array['selected'] = $user_has_access_right->user_access_rights;
            array_push($dataArray, $user_group_has_access_right_array );
        }


        $data = response()->json([
            // 'success'=>true, 
            'access_rights'=> $allAccessRight,
            'data'=> $dataArray
        ]);
        return $data;
    }

    private function checkIsAllowedAccess ($access_strings, $access_index) {
        $access_array = array_map('intval', explode(',', $access_strings));
        if (in_array($access_index, $access_array)) {
            return true;
        }
        return false;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserHasAccessRightAddRequest $request)
    {
        $credentials = $request->all();
        try {
            $roleHasPermission = new UserHasAccessRightResource;
            $roleHasPermission->user_group_id = $request->input('user_group_id');
            $roleHasPermission->user_access_rights = $request->input('user_access_rights');
            $roleHasPermission->activated = 1;

            $roleHasPermission->save();

            return response()->json(['success' => $roleHasPermission], Response::HTTP_CREATED);
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
        return new UserHasAccessRightResource(UserGroupHasAccessRight::findOrFail($id));
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
        $roleHasPermission = UserGroupHasAccessRight::findOrFail($id);
        $credentials = $request->all();
        try {

            foreach($credentials as $attribute => $prop) {
                $roleHasPermission->$attribute = $credentials[$attribute];
            }
            $roleHasPermission->save();

            return response()->json(['updated' => $roleHasPermission], Response::HTTP_CREATED);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * Update the whole User Group with Access Right Resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAllUserGroupAccessRight (Request $request) {
        if ($request->input('accessrights') != null) {
            $data = json_decode($request->input('accessrights'));
            $array = $data->mySelectedAccessArray;
     
            foreach($array as $key => $item) {
                $userGroupHasAccessRight = UserGroupHasAccessRight::findOrFail($key+1);
                $userGroupHasAccessRight->user_access_rights = implode(", ", $item );
                $userGroupHasAccessRight->save();
            }
            return response()->json(['updated' => $array], Response::HTTP_CREATED); 
        }
        return response()->json(['updated' => 'empty update'], Response::HTTP_CREATED); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleHasPermission = UserGroupHasAccessRight::findOrFail($id);
        $roleHasPermission->delete();

        return response()->json(['deleted' => $roleHasPermission], Response::HTTP_CREATED);
    }
}
