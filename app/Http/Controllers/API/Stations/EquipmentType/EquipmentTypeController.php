<?php

namespace App\Http\Controllers\API\Stations\EquipmentType;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\EquipmentType\EquipmentType;
use App\Http\Resources\Stations\EquipmentTypeResource;
use App\Http\Requests\Stations\EquipmentType\EquipmentTypeAddRequest;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return EquipmentTypeResource::collection(EquipmentType::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentTypeAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $equipment_type = new EquipmentType;
            $equipment_type->equipment_type_name = $request->input('equipment_type_name');

            if($request->input('equipment_type_description')){
                $equipment_type->equipment_type_description = $request->input('equipment_type_description');
            }
            $equipment_type->created_by = $user_id;
            $equipment_type->save();

            return response()->json(['success' => $equipment_type], Response::HTTP_CREATED);
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
        return new EquipmentTypeResource(EquipmentType::findOrFail($id));
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

        $equipment_type = EquipmentType::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $equipment_type->$attribute = $credentials[$attribute];
            }

            $equipment_type->updated_by = $user_id;
            $equipment_type->save();

            return response()->json(['updated' => $equipment_type], Response::HTTP_CREATED);
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
        $equipment_type = EquipmentType::findOrFail($id);
        $equipment_type->delete();

        return response()->json(['deleted' => $equipment_type], Response::HTTP_CREATED);
    }
}
