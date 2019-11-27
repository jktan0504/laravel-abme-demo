<?php

namespace App\Http\Controllers\API\Stations\MotorBrand;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Stations\MotorBrand\MotorBrand;
use App\Http\Resources\Stations\MotorBrandResource;
use App\Http\Requests\Stations\MotorBrand\MotorBrandAddRequest;


class MotorBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return MotorBrandResource::collection(MotorBrand::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotorBrandAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $motor_brand = new MotorBrand;
            $motor_brand->motor_brand_name = $request->input('motor_brand_name');

            if($request->input('motor_brand_description')){
                $motor_brand->motor_brand_description = $request->input('motor_brand_description');
            }
            $motor_brand->created_by = $user_id;
            $motor_brand->save();

            return response()->json(['success' => $motor_brand], Response::HTTP_CREATED);
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
        return new MotorBrandResource(MotorBrand::findOrFail($id));
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

        $motor_brand = MotorBrand::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $motor_brand->$attribute = $credentials[$attribute];
            }

            $motor_brand->updated_by = $user_id;
            $motor_brand->save();

            return response()->json(['updated' => $motor_brand], Response::HTTP_CREATED);
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
        $motor_brand = MotorBrand::findOrFail($id);
        $motor_brand->delete();

        return response()->json(['deleted' => $motor_brand], Response::HTTP_CREATED);
    }
}
