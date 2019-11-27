<?php

namespace App\Http\Controllers\API\Notifications;

use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Notifications\NotificationModel;
use App\Models\Reports\FaultCallService\FaultCallService;
use App\Models\Reports\FieldVisitService\FieldVisitService;
use App\Http\Resources\Notification\NotificationResource;
use App\Http\Resources\ReportServices\FaultCallService\FaultCallResource;
use App\Http\Resources\ReportServices\FieldVisitService\FieldVisitResource;

class NotificationMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');
        $user = Auth::user();
        $notifications = Auth::user()->notifications;

        return NotificationResource::collection($notifications);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readNotificationAndFormDetails(Request $request)
    {
        $report_type = $request->input('report_type');
        $report_num = $request->input('report_no');
        $notification_uuid = $request->input('notification_uuid');

        $notification = NotificationModel::where('id', $notification_uuid)->first();
        $notification->read_at = now();
        $notification->save();

        if ($report_type === 'FRS') {
            $allReport = FaultCallService::all();
            $result = array();
            $found = false;

            foreach ($allReport as $reportIndex => $reportProps) {
                $data[$reportIndex] = decrypt($allReport[$reportIndex]->report_no);
                if (decrypt($allReport[$reportIndex]->report_no) == $report_num) {
                    //$result = FaultCallService::findOrFail($allReport[$reportIndex]->id);
                    $result = FaultCallService::with('user', 'station')
                                ->where('id', $allReport[$reportIndex]->id)
                                ->first();
                    $found = true;
                }
                else {
                    $result['found'] = false;

                }
            }

            if ($found) {
                return new FaultCallResource($result);
            }
            else {
                return response()->json(['failed' => $data], Response::HTTP_CREATED);
            }
        }

        else {
            $allReport = FieldVisitService::all();
            $result = array();
            $found = false;

            foreach ($allReport as $reportIndex => $reportProps) {
                if (decrypt($allReport[$reportIndex]->report_no) == $report_num) {
                    $result = FieldVisitService::findOrFail($allReport[$reportIndex]->id);
                    $found = true;
                }
                else {
                    $result['found'] = false;
                }
            }

            if ($found) {
                return new FieldVisitResource($result);
            }
            else {
                return response()->json(['failed' => $result], Response::HTTP_CREATED);
            }
        }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyByUUID(Request $request)
    {
        $notification_uuid = $request->input('notification_uuid');

        $notification = NotificationModel::where('id', $notification_uuid)->firstOrFail();;
        $notification->delete();

        return response()->json(['deleted' => $notification], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = NotificationModel::findOrFail($id);
        $notification->delete();

        return response()->json(['deleted' => $notification], Response::HTTP_CREATED);
    }
}
