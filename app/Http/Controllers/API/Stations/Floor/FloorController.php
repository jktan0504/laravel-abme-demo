<?php

namespace App\Http\Controllers\API\Stations\Floor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\Floor\Floor;
use App\Http\Resources\Stations\FloorResource;
use App\Http\Requests\Stations\Floor\FloorAddRequest;


class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return FloorResource::collection(Floor::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FloorAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $floor = new Floor;
            $floor->floor_name = $request->input('floor_name');

            if($request->input('floor_description')){
                $floor->floor_description = $request->input('floor_description');
            }
            $floor->created_by = $user_id;
            $floor->save();

            return response()->json(['success' => $floor], Response::HTTP_CREATED);
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
        return new FloorResource(Floor::findOrFail($id));
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

        $floor = Floor::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $floor->$attribute = $credentials[$attribute];
            }

            $floor->updated_by = $user_id;
            $floor->save();

            return response()->json(['updated' => $floor], Response::HTTP_CREATED);
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
        $floor = Floor::findOrFail($id);
        $floor->delete();

        return response()->json(['deleted' => $floor], Response::HTTP_CREATED);
    }
}
