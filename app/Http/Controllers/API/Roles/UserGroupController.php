<?php

namespace App\Http\Controllers\API\Roles;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\Role\UserGroup;
use App\Models\Role\UserAccessRight;
use App\Models\Role\UserGroupHasAccessRight;
use App\Http\Resources\Roles\UserGroupResource;
use App\Http\Requests\Roles\UserGroup\UserGroupAddRequest;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserGroupResource::collection(UserGroup::all());
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
            $role = new UserGroup;
            $role->user_group_name = $request->input('user_group_name');

            if($request->input('user_group_description')){
                $role->user_group_description = $request->input('user_group_description');
            }

            if ($role->save()) {

                $all_permissions = UserAccessRight::all();
                $all_roles = UserGroup::all();
                $all_role_permission = UserGroupHasAccessRight::all();

                if ($all_roles) {
                    foreach($all_roles as $role_attribute => $role_prop)
                    {
                        if ($all_permissions) {
                            foreach($all_permissions as $permission_attribute => $permission_prop)
                            {
                                if ($all_role_permission->count() > 1) {
                                    $current_roleHasPermission = UserGroupHasAccessRight::all()
                                                                    ->where('user_group_id', $all_roles[$role_attribute]->id)
                                                                    ->where('user_access_right_id', $all_permissions[$permission_attribute]->id);
                                    if ($current_roleHasPermission->count() >= 1) {
                                    }
                                    else {
                                        $roleHasPermission = new UserGroupHasAccessRight;
                                        $roleHasPermission->user_group_id = $all_roles[$role_attribute]->id;
                                        $roleHasPermission->user_access_right_id = $all_permissions[$permission_attribute]->id;
                                        $roleHasPermission->save();
                                    }
                                }
                                else {
                                    $roleHasPermission = new UserGroupHasAccessRight;
                                    $roleHasPermission->user_group_id = $all_roles[$role_attribute]->id;
                                    $roleHasPermission->user_access_right_id = $all_permissions[$permission_attribute]->id;
                                    $roleHasPermission->save();
                                }
                            }
                        }
                    }
                }


            }

            return response()->json(['success' => $role], Response::HTTP_CREATED);
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
        $role = UserGroup::findOrFail($id);
        $credentials = $request->all();
        try {

            foreach($credentials as $attribute => $prop) {
                $role->$attribute = $credentials[$attribute];
            }
            $role->save();

            return response()->json(['updated' => $role], Response::HTTP_CREATED);
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
        $role = UserGroup::findOrFail($id);
        $role->delete();

        return response()->json(['deleted' => $role], Response::HTTP_CREATED);
    }
}
