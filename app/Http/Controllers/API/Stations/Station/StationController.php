<?php

// DEPRECATED -- NOT USING THIS

namespace App\Http\Controllers\API\Stations\Station;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\Station;
use App\Http\Resources\Stations\StationResource;
use App\Http\Requests\Stations\Station\StationAddRequest;


class StationController extends Controller
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

        $credentials = $request->all();

        try {
            $station = new Station;
            $station->station_no = $request->input('station_no');
            $station->station_name = $request->input('station_name');
            $station->floor_id = $request->input('floor_id');

            if($request->input('equipment_type_id')){
                $station->equipment_type_id = $request->input('equipment_type_id');
            }

            if($request->input('equipment_sub_type_id')){
                $station->equipment_sub_type_id = $request->input('equipment_sub_type_id');
            }

            if($request->input('cd_noncd_flag')){
                $station->cd_noncd_flag = $request->input('cd_noncd_flag');
            }

            if($request->input('equipment_descriptions')){
                $station->equipment_descriptions = $request->input('equipment_descriptions');
            }

            if($request->input('location')){
                $station->location = $request->input('location');
            }

            if($request->input('location_id')){
                $station->location_id = $request->input('location_id');
            }

            if($request->input('brand_id')){
                $station->brand_id = $request->input('brand_id');
            }

            if($request->input('model')){
                $station->model = $request->input('model');
            }

            if($request->input('series')){
                $station->series = $request->input('series');
            }

            if($request->input('motor_brand_id')){
                $station->motor_brand_id = $request->input('motor_brand_id');
            }

            if($request->input('motor_model')){
                $station->motor_model = $request->input('motor_model');
            }

            if($request->input('motor_serial')){
                $station->motor_serial = $request->input('motor_serial');
            }

            if($request->input('motor_kw')){
                $station->motor_kw = $request->input('motor_kw');
            }

            if($request->input('belt_size')){
                $station->belt_size = $request->input('belt_size');
            }

            if($request->input('grease_type_id')){
                $station->grease_type_id = $request->input('grease_type_id');
            }

            if($request->input('panel_type_id')){
                $station->panel_type_id = $request->input('panel_type_id');
            }

            if($request->input('ecs_control_room_location')){
                $station->ecs_control_room_location = $request->input('ecs_control_room_location');
            }

            if($request->input('remarks')){
                $station->remarks = $request->input('remarks');
            }

            if($request->input('status')){
                $station->status = $request->input('status');
            }

            $station->created_by = $user_id;
            $station->save();

            return response()->json(['success' => $station], Response::HTTP_CREATED);
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
