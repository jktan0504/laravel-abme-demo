<?php

namespace App\Http\Controllers\API\Stations\PanelType;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\PanelType\PanelType;
use App\Http\Resources\Stations\PanelTypeResource;
use App\Http\Requests\Stations\PanelType\PanelTypeAddRequest;


class PanelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return PanelTypeResource::collection(PanelType::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PanelTypeAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $panel_type = new PanelType;
            $panel_type->panel_type_name = $request->input('panel_type_name');

            if($request->input('panel_type_description')){
                $panel_type->panel_type_description = $request->input('panel_type_description');
            }
            $panel_type->created_by = $user_id;
            $panel_type->save();

            return response()->json(['success' => $panel_type], Response::HTTP_CREATED);
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
        return new PanelTypeResource(PanelType::findOrFail($id));
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

        $panel_type = PanelType::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $panel_type->$attribute = $credentials[$attribute];
            }

            $panel_type->updated_by = $user_id;
            $panel_type->save();

            return response()->json(['updated' => $panel_type], Response::HTTP_CREATED);
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
        $panel_type = PanelType::findOrFail($id);
        $panel_type->delete();

        return response()->json(['deleted' => $panel_type], Response::HTTP_CREATED);
    }
}
