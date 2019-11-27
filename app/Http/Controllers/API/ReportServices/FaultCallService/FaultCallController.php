<?php

namespace App\Http\Controllers\API\ReportServices\FaultCallService;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReportServices\ReportServiceNotification;

use App\Lib\CommzGate\CommzGateServices;

use App\Models\UserGroup\User\User;
use App\Models\SMS\Sms;
use App\Models\SMS\SmsSetting;
use App\Models\Station\Station;
use App\Models\Mails\MailList;
use App\Models\Reports\FaultCallService\FaultCallService;

use App\Models\Stations\Locations\Location;
use App\Http\Resources\ReportServices\FaultCallService\FaultCallResource;
use App\Http\Resources\ReportServices\FieldVisitService\Category\FieldVisitCategoryResource;
use App\Http\Requests\ReportServices\FaultCallService\FaultCallAddRequest;

use App\Models\Links\ShortenLink;

// PDF
use PDF;

// Report
use App\Lib\Report\Report;

// DateTime
use Carbon\Carbon;

// Mail System
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportServices\FaultCallService\FaultCallReportMail;

class FaultCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReportFormat(Request $request)
    {
        $report = new Report();
        $report_type = $request->input('report_type');
        $report_no = $report->generateReportID($report_type);
        return response()->json(['success' => $report_no], Response::HTTP_CREATED);
    }

    /**
     * ADMIN PURPOSE - ALL WITHOUT STATUS FILTER
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        if ($request->input('report_no') != null && $request->input('user_id') == null && $request->input('status') == null && $request->input('sbst') == null && $request->input('abme') == null) {
            $report_num = $request->input('report_no');
            $allReport = FaultCallService::all();
            $result = array();
            $found = false;

            foreach ($allReport as $reportIndex => $reportProps) {
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
                return new FaultCallResource($result);
            }

        }

        else if ($request->input('report_no') == null && $request->input('user_id') != null && $request->input('status') == null && $request->input('sbst') == null && $request->input('abme') == null) {
            $created_by_id = $request->input('user_id');
            $fv_report =  FaultCallService::with('user', 'station')
                    ->where('created_by', $created_by_id)
                    ->orderBy('id','desc')
                    ->orderBy('status', 'asc')
                    ->paginate($per_page);

            return FaultCallResource::collection($fv_report);
        }
        // NEW ADD
        else if ($request->input('report_no') == null && $request->input('user_id') != null && $request->input('status') != null && $request->input('sbst') == null && $request->input('abme') == null) {
            $query_status = $request->input('status');

            if ($query_status == 'incomplete') {
                $created_by_id = $request->input('user_id');
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('created_by', $created_by_id)
                        ->where('status', '!=' , '1')
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            else {
                $created_by_id = $request->input('user_id');
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('created_by', $created_by_id)
                        ->where('status', $query_status)
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            return FaultCallResource::collection($fv_report);
        }

        else if ($request->input('report_no') == null && $request->input('user_id') == null && $request->input('status') != null && $request->input('sbst') == null && $request->input('abme') == null) {
            $query_status = $request->input('status');

            if ($query_status == 'incomplete') {
                $created_by_id = $request->input('user_id');
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('status', '!=' , '1')
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            else {
                $created_by_id = $request->input('user_id');
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('status', $query_status)
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            return FaultCallResource::collection($fv_report);
        }

        else if ($request->input('report_no') == null && $request->input('user_id') != null && $request->input('status') == null && $request->input('sbst') != null && $request->input('abme') == null) {
            $query_sbst = $request->input('sbst');
            $signed_user_id = $request->input('user_id');

            if ($query_sbst == 'yes') {
                $created_by_id = $request->input('user_id');
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('witness_by_sbst_user_id', $signed_user_id)
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            else {
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('witness_by_sbst_signature', null)
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            return FaultCallResource::collection($fv_report);
        }

        // For Non Admin User Group
        else if ($request->input('report_no') == null && $request->input('user_id') != null && $request->input('status') == null && $request->input('sbst') == null && $request->input('abme') != null) {
            $query_sbme = $request->input('abme');
            $signed_user_id = $request->input('user_id');

            if ($query_sbme == 'incomplete') {

                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('status', '!=' , '1')
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            else {
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('status', '1')
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            return FaultCallResource::collection($fv_report);
        }

        // For Admin User Group
        else if ($request->input('report_no') == null && $request->input('user_id') == null && $request->input('status') == null && $request->input('sbst') == null && $request->input('abme') != null) {
            $query_sbme = $request->input('abme');

            if ($query_sbme == 'incomplete') {

                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('status', '!=' , '1')
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            else {
                $fv_report =  FaultCallService::with('user', 'station')
                        ->where('status', '1')
                        ->orderBy('id','desc')
                        ->orderBy('status', 'asc')
                        ->paginate($per_page);
            }
            return FaultCallResource::collection($fv_report);
        }

        else {
            $fv_report = FaultCallService::with('user', 'station')
                ->orderBy('id','desc')
                ->orderBy('status', 'asc')
                // ->orderByRaw("FIELD(status , '0', '1', '2')")
                ->paginate($per_page);

            return FaultCallResource::collection($fv_report);
        }
    }

    /**
     * ADMIN PURPOSE - UNAUTH
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReportByReportNoWithoutAuth(Request $request)
    {
        $per_page = $request->input('per_page');

        if ($request->input('report_no') != null && $request->input('user_id') == null && $request->input('status') == null && $request->input('sbst') == null && $request->input('abme') == null) {
            $report_num = $request->input('report_no');
            $allReport = FaultCallService::all();
            $result = array();
            $found = false;

            foreach ($allReport as $reportIndex => $reportProps) {
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
                return $result;
            }

        }

        else {
            $fv_report = FaultCallService::with('user', 'station')
                ->orderBy('id','desc')
                ->orderBy('status', 'asc')
                // ->orderByRaw("FIELD(status , '0', '1', '2')")
                ->paginate($per_page);

            return FaultCallResource::collection($fv_report);
        }
    }


    /**
     * Generate a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportSummaryByMonthYear(Request $request) {
        $month = $request->input('month');
        $year = $request->input('year');

        $fv_report = FaultCallService::with('user', 'station')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('id','asc')->get();


        return FaultCallResource::collection($fv_report);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaultCallAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        // Domain
        $host_url = env('DOMAIN_URL');
        $dateTime = Carbon::now();
        $report = new Report();

        $result = array();

        if ($request->input('num_of_report') != null) {

            $totalNumberOfReport = $request->input('num_of_report');
            $totalNumberOfReportArray = range(0, $totalNumberOfReport-1);

            foreach($totalNumberOfReportArray as $input => $prop) {

                $fr_report = new FaultCallService;

                // report type
                if ($request->input('report_type') != null) {
                    $report_type = $request->input('report_type');
                }
                else {
                    $report_type = 'FR';
                }

                // report no
                if ($input == 0) {
                    if ($request->input('report_no')) {
                        $fr_report->report_no = encrypt($request->input('report_no'));
                    }
                    else {
                        $report_no = $report->generateReportID($report_type);
                        $fr_report->report_no = encrypt($report_no);
                    }
                }
                else {
                    $report_no = $report->generateReportID($report_type);
                    $fr_report->report_no = encrypt($report_no);
                }

                $fr_report->user_id = encrypt($user_id);

                if ($request->input('station_id')) {
                    $fr_report->station_id = encrypt($request->input('station_id'));
                }
                else {
                    $fr_report->station_id = encrypt(1);
                }

                if ($request->input('contact_person')) {
                    $fr_report->contact_person = encrypt($request->input('contact_person'));
                }

                if ($request->input('contact_person_no')) {
                    $fr_report->contact_person_no = encrypt($request->input('contact_person_no'));
                }

                if ($request->input('fault_call_receive_date')) {
                    $fr_report->fault_call_receive_date = encrypt($request->input('fault_call_receive_date'));
                }

                if ($request->input('fault_call_receive_time')) {
                    $fr_report->fault_call_receive_time = encrypt($request->input('fault_call_receive_time'));
                }

                if ($request->input('arrival_date')) {
                    $fr_report->arrival_date = encrypt($request->input('arrival_date'));
                }

                if ($request->input('arrival_time')) {
                    $fr_report->arrival_time = encrypt($request->input('arrival_time'));
                }

                if ($input == 0) {
                    if ($request->input('fault_alarm_inspection_desc')) {
                        $fr_report->fault_alarm_inspection_desc = encrypt($request->input('fault_alarm_inspection_desc'));
                    }

                    if ($request->input('remarks')) {
                        $fr_report->remarks = encrypt($request->input('remarks'));
                    }
                }

                if ($input == 1) {
                    if ($request->input('fault_alarm_inspection_desc2')) {
                        $fr_report->fault_alarm_inspection_desc = encrypt($request->input('fault_alarm_inspection_desc2'));
                    }

                    if ($request->input('remarks2')) {
                        $fr_report->remarks = encrypt($request->input('remarks2'));
                    }
                }

                if ($input == 2) {
                    if ($request->input('fault_alarm_inspection_desc3')) {
                        $fr_report->fault_alarm_inspection_desc = encrypt($request->input('fault_alarm_inspection_desc3'));
                    }

                    if ($request->input('remarks3')) {
                        $fr_report->remarks = encrypt($request->input('remarks3'));
                    }
                }

                if ($input == 3) {
                    if ($request->input('fault_alarm_inspection_desc4')) {
                        $fr_report->fault_alarm_inspection_desc = encrypt($request->input('fault_alarm_inspection_desc4'));
                    }

                    if ($request->input('remarks4')) {
                        $fr_report->remarks = encrypt($request->input('remarks4'));
                    }
                }

                if ($input == 4) {
                    if ($request->input('fault_alarm_inspection_desc5')) {
                        $fr_report->fault_alarm_inspection_desc = encrypt($request->input('fault_alarm_inspection_desc5'));
                    }

                    if ($request->input('remarks5')) {
                        $fr_report->remarks = encrypt($request->input('remarks5'));
                    }
                }

                if ($request->input('fault_alarm_inspection_reason')) {
                    $fr_report->fault_alarm_inspection_reason = encrypt($request->input('fault_alarm_inspection_reason'));
                }

                if ($request->input('fi_action_taken_outcome_desc')) {
                    $fr_report->fi_action_taken_outcome_desc = encrypt($request->input('fi_action_taken_outcome_desc'));
                }

                if ($request->input('fault_alarm_desc')) {
                    $fr_report->fault_alarm_desc = encrypt($request->input('fault_alarm_desc'));
                }

                if ($request->input('fault_alarm_reason')) {
                    $fr_report->fault_alarm_reason = encrypt($request->input('fault_alarm_reason'));
                }

                if ($request->input('fr_action_taken_outcome_desc')) {
                    $fr_report->fr_action_taken_outcome_desc = encrypt($request->input('fr_action_taken_outcome_desc'));
                }

                if ($request->input('fault_alarm_inspection_completion_date')) {
                    $fr_report->fault_alarm_inspection_completion_date = encrypt($request->input('fault_alarm_inspection_completion_date'));
                }

                if ($request->input('fault_alarm_inspection_completion_time')) {
                    $fr_report->fault_alarm_inspection_completion_time = encrypt($request->input('fault_alarm_inspection_completion_time'));
                }

                if ($request->input('inspection_conducted_by_name')) {
                    $fr_report->inspection_conducted_by_name = encrypt($request->input('inspection_conducted_by_name'));
                }

                if ($request->input('witness_by_abme_name')) {
                    $fr_report->witness_by_abme_name = encrypt($request->input('witness_by_abme_name'));
                }

                if ($request->input('witness_by_sbst_name')) {
                    $fr_report->witness_by_sbst_name = encrypt($request->input('witness_by_sbst_name'));
                }

                if ($request->input('status')) {
                    // $fr_report->status = encrypt($request->input('status'));
                    $fr_report->status = '2';
                }
                else {
                    $fr_report->status = '2';
                }

                if ($request->input('arrived_station')) {
                    $fr_report->arrived_station = encrypt($request->input('arrived_station'));
                }

                $fr_report->created_by = $user_id;

                if ($fr_report->save())
                {
                    $fr_report_id = $fr_report->id;

                    if ($request->hasFile('pic_1'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/pic1';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('pic_1');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->pic_1 = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('pic_2'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/pic2';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('pic_2');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->pic_2 = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('pic_3'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/for-'.$fr_report_id.'/pic3';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('pic_3');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->pic_3 = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('pic_4'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/for/fr-'.$fr_report_id.'/pic4';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('pic_4');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->pic_4 = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('pic_5'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/pic5';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('pic_5');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->pic_5 = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('inspection_conducted_by_signature'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/inspection_sign';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('inspection_conducted_by_signature');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->inspection_conducted_by_signature = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('witness_by_abme_signature'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/witness_abme';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('witness_by_abme_signature');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->witness_by_abme_signature = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($request->hasFile('witness_by_sbst_signature'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/witness_abst';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('witness_by_sbst_signature');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fr_report->witness_by_sbst_signature = encrypt($db_path);
                        $fr_report->save();
                    }

                    if ($fr_report->status!= null) {
                        $data = array(
                           'report_id' => decrypt($fr_report->report_no),
                           'status' => $fr_report->status,
                        );
                    }
                    else {
                        $data = array(
                           'report_id' => decrypt($fr_report->report_no),
                           'status' => 'New Job',
                        );
                    }

                    if ($request->input('receiver_list')) {
                        $receiver_list = $request->input('receiver_list');
                        $receiver_list_array = array_map('intval', explode(',', $receiver_list));
                        $fr_report->receiver_list = $receiver_list;
                        $fr_report->save();
                    }


                    // Notification
                    $data['report_type'] = 'FRS';
                    $data['link'] = '/reportservices/frs?report_no='.$data['report_id'].'';
                    $data['submitted_by'] = $user->full_name;
                    $data['submitted_by_id'] = $user->id;
                    $data['created_at'] = $fr_report->created_at;
                    $data['form_action_title'] = 'Submission of FRS';
                    $data['form_action'] = 'submitted';
                    $data['notification_theme_color'] = 'primary';
                    $data['notification_icon'] = 'assignment';

                    if ($fr_report->station_id) {
                        $station = Station::findOrFail(decrypt($fr_report->station_id));
                        $data['station_id']  = $station->station_name.'('.$station->station_no.')';
                    }

                    if ($fr_report->user_id) {
                        $data['user_id']  = decrypt($fr_report->user_id);
                    }

                    if ($fr_report->contact_person) {
                        $data['contact_person']  = decrypt($fr_report->contact_person);
                    }

                    if ($fr_report->contact_person_no) {
                        $data['contact_person_no']  = decrypt($fr_report->contact_person_no);
                    }

                    if ($fr_report->fault_call_receive_date) {
                        $data['fault_call_receive_date']  = decrypt($fr_report->fault_call_receive_date);
                    }

                    if ($fr_report->fault_call_receive_time) {
                        $data['fault_call_receive_time']  = decrypt($fr_report->fault_call_receive_time);
                    }

                    if ($fr_report->arrival_date) {
                        $data['arrival_date']  = decrypt($fr_report->arrival_date);
                    }
                    else {
                        $data['arrival_date']  = "";
                    }

                    if ($fr_report->arrival_time) {
                        $data['arrival_time']  = decrypt($fr_report->arrival_time);
                    }
                    else {
                        $data['arrival_time']  = "";
                    }

                    if ($fr_report->fault_alarm_inspection_desc) {
                        $data['fault_alarm_inspection_desc']  = decrypt($fr_report->fault_alarm_inspection_desc);
                    }
                    else {
                        $data['fault_alarm_inspection_desc']  = "";
                    }

                    if ($fr_report->fault_alarm_inspection_reason) {
                        $data['fault_alarm_inspection_reason']  = decrypt($fr_report->fault_alarm_inspection_reason);
                    }
                    else {
                        $data['fault_alarm_inspection_reason']  = "";
                    }

                    if ($fr_report->fi_action_taken_outcome_desc) {
                        $data['fi_action_taken_outcome_desc']  = decrypt($fr_report->fi_action_taken_outcome_desc);
                    }
                    else {
                        $data['fi_action_taken_outcome_desc']  = "";
                    }

                    if ($fr_report->fault_alarm_desc) {
                        $data['fault_alarm_desc']  = decrypt($fr_report->fault_alarm_desc);
                    }
                    else {
                        $data['fault_alarm_desc']  = "";
                    }

                    if ($fr_report->fault_alarm_reason) {
                        $data['fault_alarm_reason']  = decrypt($fr_report->fault_alarm_reason);
                    }
                    else {
                        $data['fault_alarm_reason']  = "";
                    }

                    if ($fr_report->fr_action_taken_outcome_desc) {
                        $data['fr_action_taken_outcome_desc']  = decrypt($fr_report->fr_action_taken_outcome_desc);
                    }
                    else {
                        $data['fr_action_taken_outcome_desc']  = "";
                    }

                    if ($fr_report->fault_alarm_inspection_completion_date) {
                        $data['fault_alarm_inspection_completion_date']  = decrypt($fr_report->fault_alarm_inspection_completion_date);
                    }
                    else {
                        $data['fault_alarm_inspection_completion_date']  = "";
                    }

                    if ($fr_report->fault_alarm_inspection_completion_time) {
                        $data['fault_alarm_inspection_completion_time']  = decrypt($fr_report->fault_alarm_inspection_completion_time);
                    }
                    else {
                        $data['fault_alarm_inspection_completion_time']  = "";
                    }

                    if ($fr_report->remarks) {
                        $data['remarks']  = decrypt($fr_report->remarks);
                    }
                    else {
                        $data['remarks']  = "";
                    }

                    if ($fr_report->inspection_conducted_by_name) {
                        $data['inspection_conducted_by_name']  = decrypt($fr_report->inspection_conducted_by_name);
                    }
                    else {
                        $data['inspection_conducted_by_name']  = "";
                    }

                    if ($fr_report->inspection_conducted_by_signature) {
                        $data['inspection_conducted_by_signature']  = decrypt($fr_report->inspection_conducted_by_signature);
                    }
                    else {
                        $data['inspection_conducted_by_signature']  = "";
                    }

                    if ($fr_report->witness_by_abme_name) {
                        $data['witness_by_abme_name']  = decrypt($fr_report->witness_by_abme_name);
                    }
                    else {
                        $data['witness_by_abme_name']  = "";
                    }

                    if ($fr_report->witness_by_abme_signature) {
                        $data['witness_by_abme_signature']  = decrypt($fr_report->witness_by_abme_signature);
                    }
                    else {
                        $data['witness_by_abme_signature']  = "";
                    }

                    if ($fr_report->witness_by_sbst_name) {
                        $data['witness_by_sbst_name']  = decrypt($fr_report->witness_by_sbst_name);
                    }
                    else {
                        $data['witness_by_sbst_name']  = "";
                    }

                    if ($fr_report->witness_by_sbst_signature) {
                        $data['witness_by_sbst_signature']  = decrypt($fr_report->witness_by_sbst_signature);
                    }
                    else {
                        $data['witness_by_sbst_signature']  = "";
                    }

                    if ($fr_report->arrived_station) {
                        $data['arrived_station']  = decrypt($fr_report->arrived_station);
                    }
                    else {
                        $data['arrived_station']  = "";
                    }

                    if ($fr_report->pic_1) {
                        $data['pic_1']  = decrypt($fr_report->pic_1);
                    }
                    else {
                        $data['pic_1']  = null;
                    }

                    if ($fr_report->pic_2) {
                        $data['pic_2']  = decrypt($fr_report->pic_2);
                    }

                    if ($fr_report->pic_3) {
                        $data['pic_3']  = decrypt($fr_report->pic_3);
                    }

                    if ($fr_report->pic_4) {
                        $data['pic_4']  = decrypt($fr_report->pic_4);
                    }

                    if ($fr_report->pic_5) {
                        $data['pic_5']  = decrypt($fr_report->pic_5);
                    }

                    // send mail to email list
                    $this->sendMailToMailList($data);

                    // send sms to admin when engineer or station master submit the form
                    $commzGate = new CommzGateServices();
                    // admins
                    $admins = User::where('user_group_id', 1)->get();
                    //change to receiver list
                    // global
                    // $receiver_list = SmsSetting::findOrFail(1); // global
                    // $receiver_list_array = array_map('intval', explode(',', $receiver_list->receiver_list));

                    // own frs sms listing
                    if ($request->input('receiver_list')) {
                        $receiver_list = $request->input('receiver_list');
                        $receiver_list_array = array_map('intval', explode(',', $receiver_list));

                        // temp turn ON the sms server
                        // SMS
                        foreach($receiver_list_array as $receiver_user_id) {

                            $receiver = User::where('id', $receiver_user_id)->first();
                            $user_own_contact = $data['contact_person_no'];
                            $receiver_number = $receiver->contact;
                            // $message = $data['contact_person'].' ('.$user_own_contact.'),'.$data['station_id'].' had reported a Fault Call on '.$fr_report->created_at.'. Call the number above for queries.' ;
                            $acknowledge_link = 'http://119.73.149.51/app/frs/acknowledge?rp='.$data['report_id'].'&ph='.$data['contact_person_no'];
                            
                            $shortenLink = new ShortenLink;
                            $shortenLink->actual_link = $acknowledge_link;
                            if ($shortenLink->save()) {
                                $id = $shortenLink->id + 100000000000;
                                $shortenLink->unique_code = base_convert($id.$data['report_id'].$data['contact_person_no'], 10, 36);
                                $shortenLink->save();
                            }
                            $shortenLink->save();

                            $acknowledge_shortenLink = 'http://119.73.149.51/r?c='.$shortenLink->unique_code;

                            $message = $data['station_id'].',Report No.('.$data['report_id'].') had reported a Fault Call on '.$fr_report->created_at.' Kindly Contact '.$data['contact_person'].' ('.$user_own_contact.') should there be any queries. Click '.$acknowledge_shortenLink.' to acknowledge attending the Fault Calls';
                            
                            $formattedMessage = preg_replace('/\s+/', "+", $message);

                            $responseFull = $commzGate->sendToOneReceipient(
                                $receiver_number,
                                $formattedMessage
                            );

                            $resultCode = $responseFull->original['success']['code'];
                            $successCode = '01010';

                            $parts = explode( ',', $resultCode); //part[0] = code, part[1] = id

                            // SMS is successfully sent
                            if ($parts[0] === $successCode) {
                                $new_sms = new Sms;
                                $new_sms->sender_id = $user_id;
                                $new_sms->receiver_id = $receiver->id;
                                $new_sms->receiver_number = $receiver_number;
                                $new_sms->message = $message;
                                $new_sms->msg_response_code = $successCode;
                                $new_sms->commzgate_msg_id = $parts[1];
                                $new_sms->save();
                            }
                        }
                    }




                    // local notification
                    $this->sendNotification($admins, $data);
                }

                array_push($result, $fr_report);

            }

            return response()->json(['success' => $result], Response::HTTP_CREATED);
        }
        else {
            return response()->json(['failed' => 'foget to add number of report'], Response::HTTP_OK);
        }
        return response()->json(['success' => $fr_report], Response::HTTP_CREATED);
    }

    private function sendMailToMailList($data)
    {
        $allmails = MailList::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('emails.reportservices.faultcallservice.faultCallReport', compact('data'))->setPaper('a4')->setWarnings(false);

        foreach($allmails as $mail_index => $mail_props) {

            Mail::to($allmails[$mail_index]->mail_email)
                ->send(new FaultCallReportMail($data, $pdf->output()), $data,
                    function ($message) use ($data) {
                    });
        }
    }

    private function sendNotification($admins, $data) {
        // local database notifications
        Notification::send($admins, new ReportServiceNotification($data));
    }

    /**
     * Update And Acknowledge FRS a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acknowledgeReport(Request $request) {
        if ($request->input('report_no') != null && $request->input('phone_no') != null) {
            $report_num = $request->input('report_no');
            $allReport = FaultCallService::all();
            $result = array();
            $found = false;

            foreach ($allReport as $reportIndex => $reportProps) {
                if (decrypt($allReport[$reportIndex]->report_no) == $report_num) {
                    //$result = FaultCallService::findOrFail($allReport[$reportIndex]->id);
                    $result = FaultCallService::with('user', 'station')
                                ->where('id', $allReport[$reportIndex]->id)
                                ->first();
                    $found = true;
                }
            }

            if ($found) {
                
                $user = User::where('contact', $request->input('phone_no'))->first();

                if ($user != null) {
                    if ($result->acknowledge_by != null) {
                        $result->acknowledge_by = $user->id;
                        $result->save();
                        return response()->json(['success' => 'Successfully acknowledged report no. : '.$report_num.' by '.$request->input('phone_no')], Response::HTTP_OK);
                    }
                    else {
                        return response()->json(['failed' => 'This report no. ('.$report_num.') had acknowledged by someone already. Kindly confirm with administrator'], Response::HTTP_NOT_FOUND);
                    }
                    
                }
                else {
                    return response()->json(['failed' => 'Unable to find the registered user with contact no. : '.$request->input('phone_no')], Response::HTTP_NOT_FOUND);
                }


            }
            else {
                return response()->json(['failed' => 'Unable to find the report with report no. : '.$report_num], Response::HTTP_NOT_FOUND);
            }

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
        return new FaultCallResource(FaultCallService::with('user', 'station')
                    ->where('id', $id)
                    ->first());
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
        $host_url = env('DOMAIN_URL');
        $fr_report = FaultCallService::findOrFail($id);
        $fr_report_id = $fr_report->id;
        $credentials = $request->all();

        foreach($credentials as $attribute => $prop) {

            if ($attribute == 'pic_1') {
                if ($request->hasFile('pic_1'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/pic1';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('pic_1');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->pic_1 = encrypt($db_path);
                    $fr_report->save();
                }
            }
            elseif ($attribute == 'pic_2') {
                if ($request->hasFile('pic_2'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/pic2';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('pic_2');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->pic_2 = encrypt($db_path);
                    $fr_report->save();
                }
            }

            elseif ($attribute == 'pic_3') {
                if ($request->hasFile('pic_3'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/for-'.$fr_report_id.'/pic3';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('pic_3');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->pic_3 = encrypt($db_path);
                    $fr_report->save();
                }
            }
            elseif ($attribute == 'pic_4') {
                if ($request->hasFile('pic_4'))
                {
                    $storage_content_directoryPath = '/images/reportservices/for/fr-'.$fr_report_id.'/pic4';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('pic_4');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->pic_4 = encrypt($db_path);
                    $fr_report->save();
                }
            }
            elseif ($attribute == 'pic_5') {
                if ($request->hasFile('pic_5'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/pic5';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('pic_5');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->pic_5 = encrypt($db_path);
                    $fr_report->save();
                }
            }

            elseif ($attribute == 'inspection_conducted_by_signature') {
                if ($request->hasFile('inspection_conducted_by_signature'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/inspection_sign';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('inspection_conducted_by_signature');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->inspection_conducted_by_signature = encrypt($db_path);
                    $fr_report->save();
                }
            }

            elseif ($attribute == 'witness_by_abme_signature') {
                if ($request->hasFile('witness_by_abme_signature'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/witness_abme';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('witness_by_abme_signature');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->witness_by_abme_signature = encrypt($db_path);
                    $fr_report->save();
                }
            }

            elseif ($attribute == 'witness_by_sbst_signature') {
                if ($request->hasFile('witness_by_sbst_signature'))
                {
                    $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id.'/witness_abst';
                    $storage_directoryPath = 'public'.$storage_content_directoryPath;

                    Storage::deleteDirectory($storage_directoryPath);

                    //Check is directory exists
                    if(!Storage::exists($storage_directoryPath))
                    {
                        // Generate the files
                        Storage::makeDirectory($storage_directoryPath);
                    }

                    $file = $request->file('witness_by_sbst_signature');
                    $path = $file->store($storage_directoryPath);
                    $path = str_replace("public","storage",$path);
                    $db_path = $host_url.'/'.$path;
                    $fr_report->witness_by_sbst_signature = encrypt($db_path);
                    $fr_report->save();
                }
            }
            elseif ($attribute == 'status') {
                $fr_report->$attribute = $credentials[$attribute];
                $fr_report->save();
            }

            else {
                $fr_report->$attribute = encrypt($credentials[$attribute]);
                $fr_report->save();
            }
        }

        $fr_report->updated_by = $user_id;
        $fr_report->save();

        $commzGate = new CommzGateServices();
        $report_no = decrypt($fr_report->report_no);

        // ===

        // admins
        $admins = User::where('user_group_id', 1)->get();

        //change to receiver list
        // global
        // $receiver_list = SmsSetting::findOrFail(1); // global
        // $receiver_list_array = array_map('intval', explode(',', $receiver_list->receiver_list));

        // own frs sms listing
        if ($request->input('receiver_list')) {
            $receiver_list = $request->input('receiver_list');
            $receiver_list_array = array_map('intval', explode(',', $receiver_list));

            // temp turn On the sms server
            // SMS
            foreach($receiver_list_array as $receiver_user_id) {

                $receiver = User::where('id', $receiver_user_id)->first();
                $user_own_contact = $data['contact_person_no'];
                $receiver_number = $receiver->contact;
                // $message = $data['contact_person'].' ('.$user_own_contact.'),'.$data['station_id'].' had reported a Fault Call on '.$fr_report->created_at.'. Call the number above for queries.' ;
                
                $acknowledge_link = 'http://119.73.149.51/app/frs/acknowledge?rp='.$data['report_id'].'&ph='.$data['contact_person_no'];

                $shortenLink = new ShortenLink;
                $shortenLink->actual_link = $acknowledge_link;
                if ($shortenLink->save()) {
                    $id = $shortenLink->id + 100000000000;
                    $shortenLink->unique_code = base_convert($id.$data['report_id']. $data['contact_person_no'], 10, 36);
                    $shortenLink->save();
                }
                $shortenLink->save();

 
                $acknowledge_shortenLink = 'http://119.73.149.51/r?c='.$shortenLink->unique_code;

                $message = $data['station_id'].',Report No.('.$data['report_id'].') had reported a Fault Call on '.$fr_report->created_at.' Kindly Contact '.$data['contact_person'].' ('.$user_own_contact.') should there be any queries. Click '.$acknowledge_shortenLink.' to acknowledge attending the Fault Calls';

                $formattedMessage = preg_replace('/\s+/', "+", $message);

                $responseFull = $commzGate->sendToOneReceipient(
                    $receiver_number,
                    $formattedMessage
                );

                $resultCode = $responseFull->original['success']['code'];
                $successCode = '01010';

                $parts = explode( ',', $resultCode); //part[0] = code, part[1] = id

                // SMS is successfully sent
                if ($parts[0] === $successCode) {
                    $new_sms = new Sms;
                    $new_sms->sender_id = $user_id;
                    $new_sms->receiver_id = $receiver->id;
                    $new_sms->receiver_number = $receiver_number;
                    $new_sms->message = $message;
                    $new_sms->msg_response_code = $successCode;
                    $new_sms->commzgate_msg_id = $parts[1];
                    $new_sms->save();
                }
            }
        }

        if ($fr_report->station_id) {
            $station = Station::findOrFail(decrypt($fr_report->station_id));
            $data['station_id']  = $station->station_name.'-'.$station->station_no;
        }


        // ===

        // Notification
        $data = array(
           'report_id' => decrypt($fr_report->report_no),
           'status' => $fr_report->status,
        );
        $data['report_type'] = 'FRS';
        $data['link'] = '/reportservices/frs?report_no='.$data['report_id'].'';
        $data['submitted_by'] = $user->full_name;
        $data['submitted_by_id'] = $user->id;
        $data['created_at'] = $fr_report->created_at;
        $data['form_action_title'] = 'Updated of FRS';
        $data['form_action'] = 'updated';
        $data['notification_theme_color'] = 'primary';
        $data['notification_icon'] = 'assignment';
        $this->sendNotification($admins, $data);

        return response()->json(['updated' =>  new FaultCallResource($fr_report)], Response::HTTP_CREATED);
    }

    /**
     * Bulk Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdateFormSbstSign(Request $request)
    {
        $user = Auth::user();
        $userID = $user->id;
        $host_url = env('DOMAIN_URL');

        $forms_array = array_map('intval', explode(',', $request->input('selected_forms')));

        foreach($forms_array as $form_id) {

            $fr_report = FaultCallService::findOrFail($form_id);
            $fr_report_id = $fr_report->id;

            // Avatart Profile Image Handling
            if ($request->hasFile('sbst_sign'))
            {
                // Admin Specific Avatar Images
                $storage_content_directoryPath = '/images/users/users/user-'.$userID.'/sbst';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('sbst_sign');
                $file_extension = $file->getClientOriginalExtension();
                $filename = 'sbst_sign.'.$file_extension;

                $path = $file->store($storage_directoryPath);

                $path = str_replace("public","storage",$path);
                $db_path = $host_url."/".$path;

                $user->sbst_sign = $db_path;
                $user->save();

                $fr_report->witness_by_sbst_name = encrypt($user->full_name);
                $fr_report->witness_by_sbst_signature = encrypt($user->sbst_sign);
                $fr_report->witness_by_sbst_user_id = $userID;
                $fr_report->save();
            }
            else {
                $fr_report->witness_by_sbst_name = encrypt($user->full_name);
                $fr_report->witness_by_sbst_signature = encrypt($user->sbst_sign);
                $fr_report->witness_by_sbst_user_id = $userID;
                $fr_report->save();
            }
        }

        return response()->json(['updated' => "updated sbst for user successfully"], Response::HTTP_CREATED);
    }

    // test for explode
    public function testForExplode () {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $host_url = env('DOMAIN_URL');
        $fr_report = FaultCallService::findOrFail($id);

        $fr_report_id = $fr_report->id;

        $storage_content_directoryPath = '/images/reportservices/fr/fr-'.$fr_report_id;
        $storage_directoryPath = 'public'.$storage_content_directoryPath;

        Storage::deleteDirectory($storage_directoryPath);

        $fr_report->delete();

        return response()->json(['deleted' => $fr_report], Response::HTTP_CREATED);
    }
}
