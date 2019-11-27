<?php

namespace App\Http\Controllers\API\Stations\EquipmentType;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\EquipmentType\EquipmentSubType;
use App\Http\Resources\Stations\EquipmentSubTypeResource;
use App\Http\Requests\Stations\EquipmentType\EquipmentSubTypeAddRequest;


class EquipmentSubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        $equipment_sub_type = EquipmentSubType::with('equipment_type')->paginate($per_page);

        return EquipmentSubTypeResource::collection($equipment_sub_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentSubTypeAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $equipment_sub_type = new EquipmentSubType;
            $equipment_sub_type->equipment_sub_type_name = $request->input('equipment_sub_type_name');

            $equipment_sub_type->equipment_type_id = $request->input('equipment_type_id');

            if($request->input('equipment_sub_type_description')){
                $equipment_sub_type->equipment_sub_type_description = $request->input('equipment_sub_type_description');
            }
            $equipment_sub_type->created_by = $user_id;
            $equipment_sub_type->save();

            return response()->json(['success' => $equipment_sub_type], Response::HTTP_CREATED);
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
        return new EquipmentSubTypeResource(EquipmentSubType::findOrFail($id));
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

        $equipment_sub_type = EquipmentSubType::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $equipment_sub_type->$attribute = $credentials[$attribute];
            }

            $equipment_sub_type->updated_by = $user_id;
            $equipment_sub_type->save();

            return response()->json(['updated' => $equipment_sub_type], Response::HTTP_CREATED);
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
        $equipment_sub_type = EquipmentSubType::findOrFail($id);
        $equipment_sub_type->delete();

        return response()->json(['deleted' => $equipment_sub_type], Response::HTTP_CREATED);
    }
}
