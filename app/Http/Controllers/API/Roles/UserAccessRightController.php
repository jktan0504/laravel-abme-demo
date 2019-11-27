<?php

namespace App\Http\Controllers\API\Roles;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\Role\UserGroup;
use App\Models\Role\UserAccessRight;
use App\Models\Role\UserGroupHasAccessRight;
use App\Http\Resources\Roles\UserAccessRightResource;
use App\Http\Requests\Roles\UserAccessRight\UserAccessRightAddRequest;

class UserAccessRightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return UserAccessRightResource::collection(UserAccessRight::paginate($per_page));
    }

    public function showallpermissions()
    {
        return UserAccessRightResource::collection(UserAccessRight::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAccessRightAddRequest $request)
    {
        $credentials = $request->all();
        try {
            $permission = new UserAccessRight;
            $permission->user_access_right_name = $request->input('user_access_right_name');
            if($request->input('user_access_right_id')){
                $permission->user_access_right_id = $request->input('user_access_right_id');
            }
            if($request->input('user_access_right_description')){
                $permission->user_access_right_description = $request->input('user_access_right_description');
            }
            if($request->input('remarks')){
                $permission->remarks = $request->input('remarks');
            }

            if ($permission->save()) {

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

            return response()->json(['success' => $permission], Response::HTTP_CREATED);
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
        return new UserAccessRightResource(UserAccessRight::findOrFail($id));
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
        $permission = UserAccessRight::findOrFail($id);
        $credentials = $request->all();
        try {

            foreach($credentials as $attribute => $prop) {
                $permission->$attribute = $credentials[$attribute];
            }
            $permission->save();

            return response()->json(['updated' => $permission], Response::HTTP_CREATED);
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
        $permission = UserAccessRight::findOrFail($id);
        $permission->delete();

        return response()->json(['deleted' => $permission], Response::HTTP_CREATED);
    }
}
