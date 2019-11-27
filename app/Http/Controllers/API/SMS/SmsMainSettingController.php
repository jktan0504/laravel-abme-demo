<?php

namespace App\Http\Controllers\API\SMS;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Lib\CommzGate\CommzGateServices;

use App\Models\SMS\SmsSetting;
use App\Http\Requests\Sms\SmsMainSettingRequest;
use App\Http\Resources\Sms\SmsMainSettingResource;

class SmsMainSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms_settings = SmsSetting::orderBy('id','asc')->get();

        return SmsMainSettingResource::collection($sms_settings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SmsMainSettingRequest $request)
    {
        $sms_setting = new SmsSetting;

        if ($request->input('sms_format')) {
            $sms_setting->sms_format = $request->input('sms_format');
        }

        if ($request->input('receiver_list')) {
            $sms_setting->receiver_list = $request->input('receiver_list');
        }

        if ($request->input('activated')) {
            $sms_setting->activated = $request->input('activated');
        }

        $sms_setting->save();

        return response()->json(['success' => $sms_setting], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SmsMainSettingResource(SmsSetting::findOrFail($id));
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
        $sms_setting = SmsSetting::findOrFail($id);

        $sms_setting_id = $sms_setting->id;

        $all_input = $request->all();

        foreach($all_input as $input => $prop) {

            $sms_setting->$input = $all_input[$input];
        }

        $sms_setting->save();

        return response()->json(['updated' => $sms_setting], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sms_setting = ShipmentZone::findOrFail($id);

        $sms_setting = $sms_setting->id;

        $sms_setting->delete();

        return response()->json(['deleted' => $sms_setting], Response::HTTP_OK);
    }
}
