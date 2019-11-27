<?php

namespace App\Http\Controllers\API\Stations\Locations;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\Locations\Location;
use App\Http\Resources\Stations\LocationResource;
use App\Http\Requests\Stations\Locations\LocationAddRequest;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return LocationResource::collection(Location::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $location = new Location;
            $location->location_name = $request->input('location_name');

            if($request->input('location_description')){
                $location->location_description = $request->input('location_description');
            }
            $location->created_by = $user_id;
            $location->save();

            return response()->json(['success' => $location], Response::HTTP_CREATED);
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
        return new LocationResource(Location::findOrFail($id));
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

        $location = Location::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $location->$attribute = $credentials[$attribute];
            }

            $location->updated_by = $user_id;
            $location->save();

            return response()->json(['updated' => $location], Response::HTTP_CREATED);
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
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json(['deleted' => $location], Response::HTTP_CREATED);
    }
}
