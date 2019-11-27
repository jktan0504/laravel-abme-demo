<?php

namespace App\Http\Controllers\API\Stations\Grease;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\Grease\GreaseType;
use App\Http\Resources\Stations\GreaseTypeResource;
use App\Http\Requests\Stations\EquipmentType\GreaseTypeAddRequest;


class GreaseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return GreaseTypeResource::collection(GreaseType::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $grease_type = new GreaseType;
            $grease_type->grease_type_name = $request->input('grease_type_name');

            if($request->input('grease_type_description')){
                $grease_type->grease_type_description = $request->input('grease_type_description');
            }
            $grease_type->created_by = $user_id;
            $grease_type->save();

            return response()->json(['success' => $grease_type], Response::HTTP_CREATED);
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
        return new GreaseTypeResource(GreaseType::findOrFail($id));
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

        $grease_type = GreaseType::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $grease_type->$attribute = $credentials[$attribute];
            }

            $grease_type->updated_by = $user_id;
            $grease_type->save();

            return response()->json(['updated' => $grease_type], Response::HTTP_CREATED);
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
        $grease_type = GreaseType::findOrFail($id);
        $grease_type->delete();

        return response()->json(['deleted' => $grease_type], Response::HTTP_CREATED);
    }
}
