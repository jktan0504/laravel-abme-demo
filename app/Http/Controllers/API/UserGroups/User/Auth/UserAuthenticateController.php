<?php

namespace App\Http\Controllers\API\UserGroups\User\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;

class UserAuthenticateController extends Controller
{
    /**
    * Get Auth User (Login) Details
    *
    * @param bearer token
    * @return \Illuminate\Http\Response
    */
    public function getUserDetails()
    {
        $user = Auth::user();
        $user['csrf_token'] = csrf_token();
        $user['all_notifications'] = Auth::user()->notifications;
        $user['unread_notifications'] = Auth::user()->unreadNotifications;
        return response()->json(['success' => $user], Response::HTTP_OK);
    }

    /**
    * Update User Details
    *
    * @param bearer token, Request $request
    * @return \Illuminate\Http\Response
    */
    public function updateUserDetails(Request $request)
    {
        // Getting IP
        $host_url = env('DOMAIN_URL');

        $user = Auth::user();
        $userID = $user->id;

        $all_input = $request->all();

        foreach($all_input as $input => $prop)
        {
            if($input == 'password' || $input == 'old_password')
            {
                $old_password = $request->input('old_password');
                // $user->password = bcrypt($request->input('old_password'));
                // password_verify // \Hash::check
                // dd(Auth::guard('web')->attempt(['email' => $user->email, 'password' => $old_password]));
                if (Auth::guard('web')->attempt(['email' => $user->email, 'password' => $old_password])) {
                // if (\Hash::check($old_password, $user->password)) {
                    // The old password matches the hash in the database
                    $user->password = bcrypt($request->input('password'));
                    $user->password_changed = 1;
                }
                else {
                    return response()->json(
                        ['Incorrect Password '.$user->username => $user], Response::HTTP_BAD_REQUEST);
                }

            }
            elseif ($input == 'profile_image')
            {
                if ($request->hasFile($input))
                {
                    // Vendor Specific Avatar Image
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
            ['success Update User '.$user->username => $user], Response::HTTP_OK);
    }
}
