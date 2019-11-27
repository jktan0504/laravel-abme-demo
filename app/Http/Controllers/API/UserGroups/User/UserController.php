<?php

namespace App\Http\Controllers\API\UserGroups\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserGroups\User\UserCheckUsernameRequest;
use App\Http\Resources\UserGroups\User\UserResource;
use App\Http\Requests\UserGroups\User\UserRegisterRequest;

use App\Models\UserGroup\User\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param USERNAME
     * @return Boolean
     */
    public function checkUsername(UserCheckUsernameRequest $request) {
        $validUsername = false;

        if($request->input('username')) {

            $validUsername = true;
        }
        else {
            $validUsername = false;
        }
        $validUsernameArray = array();
        $validUsernameArray['valid'] = $validUsername;

        return new UserResource($validUsernameArray);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers(Request $request)
    {
        // per_page for total pagination
        $per_page_total = $request->input('per_page');

        $users =  User::with('team', 'user_group')
                ->orderBy('user_group_id','asc')
                ->paginate($per_page_total);

        return UserResource::collection($users);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // per_page for total pagination
        $per_page_total = $request->input('per_page');
        $role_id = $request->input('user_group_id');

        $users =  User::with('team', 'user_group')
                ->where('user_group_id', $role_id)
                ->orderBy('id','asc')
                ->paginate($per_page_total);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $host_url = env('DOMAIN_URL');
        $credentials = $request->all();

        try {
            $user = New User;
            $user->username = $request->input('username');
            $user->full_name = $request->input('full_name');
            $user->company_name = $request->input('full_name');
            $user->email = $request->input('email');               // email
            $user->password = bcrypt($request->input('password')); // password
            $user->contact = $request->input('contact');
            $user->team_id = $request->input('team_id');
            $user->user_group_id = $request->input('user_group_id');

            // salt_value
            if ($request->input('salt_value'))
            {
                $user->salt_value = $request->input('salt_value');
            }

            // remarks
            if ($request->input('remarks'))
            {
                $user->remarks = $request->input('remarks');
            }

            $user->save();
            $userID = $user->id;

            // Avatart Profile Image Handling
            if ($request->hasFile('profile_image'))
            {
                // Admin Specific Avatar Images
                $storage_content_directoryPath = '/images/users/users/user-'.$userID.'/avatar';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('profile_image');
                $file_extension = $file->getClientOriginalExtension();
                $filename = 'avatar.'.$file_extension;

                $path = $file->store($storage_directoryPath);

                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;

                $user->profile_image=$db_path;
                $user->save();
            }

            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return response()->json(['success' => $user], Response::HTTP_CREATED);

        } catch (\Exception $e) {
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
        return new UserResource(User::findOrFail($id)->with('team', 'user_group')->where('id', $id)->get());
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
        $host_url = env('DOMAIN_URL');
        $user = User::findOrFail($id);
        $userID = $user->id;

        $all_input = $request->all();

        foreach($all_input as $input => $prop)
        {
            if($input == 'password')
            {
                $user->password = bcrypt($all_input[$input]);
            }
            elseif ($input == 'profile_image')
            {
                if ($request->hasFile($input))
                {
                    // Admin Specific Avatar Images
                    $storage_content_directoryPath = '/images/users/users/user-'.$userID.'/avatar';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);
                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->$input;
                    $file_extension = $file->getClientOriginalExtension();
                    $filename = 'avatar.'.$file_extension;

                    $path = $file->store($storage_directoryPath);

                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;

                    $user->profile_image=$db_path;
                }
            }
            else
            {
                $user->$input = $all_input[$input];
            }

        }

        $user->save();

        return response()->json(
            ['success User '.$user->username => $user], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $host_url = env('DOMAIN_URL');
        $user = User::findOrFail($id);
        $userID = $user->id;

        $storage_content_directoryPath = '/images/users/users/user-'.$userID;
        $storage_directoryPath = 'public'.$storage_content_directoryPath;

        Storage::deleteDirectory($storage_directoryPath);

        $user->delete();

        return response()->json(['deleted' => $user], Response::HTTP_CREATED);
    }
}
