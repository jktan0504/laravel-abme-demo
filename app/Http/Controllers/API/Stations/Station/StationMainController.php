<?php

namespace App\Http\Controllers\API\Stations\Station;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Station\Station;
use App\Http\Resources\Stations\StationResource;
use App\Http\Requests\Stations\Station\StationAddRequest;

class StationMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        if ($request->input('station_no')) {
            $station_no = $request->input('station_no');

            $stations = Station::where('station_no', $station_no)->paginate($per_page);
        }
        else {
            $stations = Station::paginate($per_page);
        }


        return StationResource::collection($stations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StationAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $station = new Station;
        $station->station_no = $request->input('station_no');
        $station->station_name = $request->input('station_name');

        if($request->input('remarks')){
            $station->remarks = $request->input('remarks');
        }

        if($request->input('status')){
            $station->status = $request->input('status');
        }


        if($request->input('activated')){
            $station->activated = $request->input('activated');
        }

        $station->created_by = $user_id;
        $station->save();

        return response()->json(['success' => $station], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new StationResource(Station::findOrFail($id));
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

        $station = Station::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $station->$attribute = $credentials[$attribute];
            }

            $station->updated_by = $user_id;
            $station->save();

            return response()->json(['updated' => $station], Response::HTTP_CREATED);
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
        $station = Station::findOrFail($id);
        $station->delete();

        return response()->json(['deleted' => $station], Response::HTTP_CREATED);
    }
}
