<?php

namespace App\Http\Controllers\API\ReportServices\FieldVisitService;

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
use App\Models\Mails\MailList;
use App\Models\Reports\FieldVisitService\FieldVisitService;
use App\Models\Reports\FieldVisitService\FieldVisitCategory;
use App\Models\Stations\Locations\Location;
use App\Http\Resources\ReportServices\FieldVisitService\FieldVisitResource;
use App\Http\Resources\ReportServices\FieldVisitService\Category\FieldVisitCategoryResource;
use App\Http\Requests\ReportServices\FieldVisitService\FieldVisitAddRequest;

// PDF
use PDF;

// Report
use App\Lib\Report\Report;

// DateTime
use Carbon\Carbon;

// Mail System
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportServices\FieldVisitService\FieldVisitReportMail;

class FieldVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        if ($request->input('report_no')) {
            $report_num = $request->input('report_no');
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
                return new FieldVisitCategoryResource($result);
            }
        }
        else if ($request->input('user_id')) {
            $created_by_id = $request->input('user_id');
            $fv_report =  FieldVisitService::where('created_by', $created_by_id)
                    ->orderBy('id','desc')
                    ->paginate($per_page);

            return FieldVisitResource::collection($fv_report);
        }
        else {
            $fv_report = FieldVisitService::orderBy('id','desc')->paginate($per_page);
            return FieldVisitResource::collection($fv_report);
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

        $fv_report = FieldVisitService::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('id','asc')->get();


        return FieldVisitResource::collection($fv_report);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldVisitAddRequest $request)
    {
        // Encryption Data
        $user = Auth::user();
        $user_id = $user->id;

        // Domain
        $host_url = env('DOMAIN_URL');
        $dateTime = Carbon::now();
        $report = new Report();

        $fv_report = new FieldVisitService;
        //$fv_report->submit_date = $dateTime->year.''.$dateTime->month.''.$dateTime->day;
        $fv_report->submit_date = encrypt($request->input('submit_date'));
        $fv_report->submit_to = encrypt($request->input('submit_to'));
        $report_no = $report->generateReportID('FV');
        $fv_report->report_no = encrypt($report_no);
        $fv_report->system = encrypt($request->input('system'));
        $fv_report->visiting_date = encrypt($request->input('visiting_date'));
        $fv_report->visiting_time = encrypt($request->input('visiting_time'));
        $fv_report->created_by = $user_id;


        if ($request->input('location')) {
            $fv_report->location = encrypt($request->input('location'));
        }

        if ($request->input('location_id')) {
            $fv_report->location_id = encrypt($request->input('location_id'));
        }

        if ($request->input('field_visit_category_id')) {
            $fv_report->field_visit_category_id = encrypt($request->input('field_visit_category_id'));
        }

        if ($request->input('field_visit_other_category')) {
            $fv_report->field_visit_other_category = encrypt($request->input('field_visit_other_category'));
        }

        if ($request->input('details_findings')) {
            $fv_report->details_findings = encrypt($request->input('details_findings'));
        }

        if ($request->input('summary')) {
            $fv_report->summary = encrypt($request->input('summary'));
        }

        if ($request->input('remarks')) {
            $fv_report->remarks = encrypt($request->input('remarks'));
        }

        if ($request->input('report_by_name_1')) {
            $fv_report->report_by_name_1 = encrypt($request->input('report_by_name_1'));
        }

        if ($request->input('report_by_name_1_date')) {
            $fv_report->report_by_name_1_date = encrypt($request->input('report_by_name_1_date'));
        }

        if ($request->input('report_by_name_2')) {
            $fv_report->report_by_name_2 = encrypt($request->input('report_by_name_2'));
        }

        if ($request->input('report_by_name_2_date')) {
            $fv_report->report_by_name_2_date = encrypt($request->input('report_by_name_2_date'));
        }

        if ($request->input('report_by_name_3')) {
            $fv_report->report_by_name_3 = encrypt($request->input('report_by_name_3'));
        }

        if ($request->input('report_by_name_3_date')) {
            $fv_report->report_by_name_3_date = encrypt($request->input('report_by_name_3_date'));
        }

        if ($request->input('status')) {
            $fv_report->status = encrypt($request->input('status'));
        }

        if ($fv_report->save())
        {
            $fv_report_id = $fv_report->id;

            if ($request->hasFile('report_by_name_1_signature'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign1';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('report_by_name_1_signature');
                $path = $file->store($storage_directoryPath);
                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;
                $fv_report->report_by_name_1_signature = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('report_by_name_2_signature'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign2';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('report_by_name_2_signature');
                $path = $file->store($storage_directoryPath);
                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;
                $fv_report->report_by_name_2_signature = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('report_by_name_3_signature'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign3';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('report_by_name_3_signature');
                $path = $file->store($storage_directoryPath);
                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;
                $fv_report->report_by_name_3_signature = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_1'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic1';
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
                $fv_report->pic_1 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_2'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic2';
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
                $fv_report->pic_2 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_3'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic3';
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
                $fv_report->pic_3 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_4'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic4';
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
                $fv_report->pic_4 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_5'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic5';
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
                $fv_report->pic_5 = encrypt($db_path);
                $fv_report->save();
            }

            $data = array(
               'report_id' => decrypt($fv_report->report_no),
               'submit_date' => decrypt($fv_report->submit_date),
               'submit_to' => decrypt($fv_report->submit_to),
               'system' => decrypt($fv_report->system),
               'visiting_date' => decrypt($fv_report->visiting_date),
               'visiting_time' => decrypt($fv_report->visiting_time),
               'details_findings'  => decrypt($fv_report->details_findings),
               'summary'  => decrypt($fv_report->summary),
               'report_by_name_1'  => decrypt($fv_report->report_by_name_1),
               'report_by_name_1_date'  => decrypt($fv_report->report_by_name_1_date),
               'report_by_name_1_signature'  => decrypt($fv_report->report_by_name_1_signature),
               'status' => decrypt($fv_report->status),
            );

            // Notification
            $data['report_type'] = 'FVS';
            $data['link'] = '/reportservices/fvs?report_no='.$data['report_id'].'';
            $data['submitted_by'] = $user->full_name;
            $data['submitted_by_id'] = $user->id;
            $data['created_at'] = $fv_report->created_at;
            $data['form_action_title'] = 'Submission of FVS';
            $data['form_action'] = 'submitted';
            $data['notification_theme_color'] = 'cyan';
            $data['notification_icon'] = 'assessment';

            if ($fv_report->location) {
                $data['location']  = decrypt($fv_report->location);
            }

            if ($fv_report->location_id) {
                $location = Location::findOrFail( decrypt($fv_report->location_id));
                $data['location']  = $location->location_name;
            }

            if ($fv_report->field_visit_category_id) {
                $id = decrypt($fv_report->field_visit_category_id);
                $category = FieldVisitCategory::findOrFail($id);

                $data['category']  = $category->category_name;
            }

            if ($fv_report->field_visit_other_category) {
                $data['other_category']  = decrypt($fv_report->field_visit_other_category);
            }

            if ($fv_report->report_by_name_2) {
                $data['report_by_name_2']  = decrypt($fv_report->report_by_name_2);
            }
            else
            {
                $data['report_by_name_2']  = null;
            }

            if ($fv_report->report_by_name_2_date) {
                $data['report_by_name_2_date']  = decrypt($fv_report->report_by_name_2_date);
            }

            if ($fv_report->report_by_name_2_signature) {
                $data['report_by_name_2_signature']  = decrypt($fv_report->report_by_name_2_signature);
            }

            if ($fv_report->report_by_name_3) {
                $data['report_by_name_3']  = decrypt($fv_report->report_by_name_3);
            }
            else
            {
                $data['report_by_name_3']  = null;
            }

            if ($fv_report->report_by_name_3_date) {
                $data['report_by_name_3_date']  = decrypt($fv_report->report_by_name_3_date);
            }

            if ($fv_report->report_by_name_3_signature) {
                $data['report_by_name_3_signature']  = decrypt($fv_report->report_by_name_3_signature);
            }

            if ($fv_report->pic_1) {
                $data['pic_1']  = decrypt($fv_report->pic_1);
            }

            if ($fv_report->pic_2) {
                $data['pic_2']  = decrypt($fv_report->pic_2);
            }

            if ($fv_report->pic_3) {
                $data['pic_3']  = decrypt($fv_report->pic_3);
            }

            if ($fv_report->pic_4) {
                $data['pic_4']  = decrypt($fv_report->pic_4);
            }

            if ($fv_report->pic_5) {
                $data['pic_5']  = decrypt($fv_report->pic_5);
            }

            $this->sendMailToMailList($data);

            // send sms to admin when engineer or station master submit the form
            $commzGate = new CommzGateServices();

            $admins = User::where('user_group_id', 1)->get();

            foreach($admins as $admin) {
                $receiver_number = $admin->contact;
                $message = '*FVS* '.$user->full_name.' ('.$user->id.') had submmited FVS report - ('.$report_no.') at '.$fv_report->created_at.'' ;

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
                    $new_sms->receiver_id = $admin->id;
                    $new_sms->receiver_number = $receiver_number;
                    $new_sms->message = $message;
                    $new_sms->msg_response_code = $successCode;
                    $new_sms->commzgate_msg_id = $parts[1];
                    $new_sms->save();
                }
            }

            $this->sendNotification($admins, $data);

        }

        return response()->json(['success' => $fv_report], Response::HTTP_CREATED); //$fv_report
    }

    function submitRealForm(Request $request) {
        $user = Auth::user();
        $user_id = $user->id;

        // Domain
        $host_url = env('DOMAIN_URL');
        $dateTime = Carbon::now();
        $report = new Report();

        $fv_report = new FieldVisitService;
        //$fv_report->submit_date = $dateTime->year.''.$dateTime->month.''.$dateTime->day;
        $fv_report->submit_date = $request->input('submit_date');
        $fv_report->submit_to = $request->input('submit_to');
        $fv_report->report_no = $report->generateReportID('FV');
        $fv_report->system = $request->input('system');
        $fv_report->visiting_date = $request->input('visiting_date');
        $fv_report->visiting_time = $request->input('visiting_time');
        $fv_report->created_by = $user_id;


        if ($request->input('location')) {
            $fv_report->location = $request->input('location');
        }

        if ($request->input('location_id')) {
            $fv_report->location_id = $request->input('location_id');
        }

        if ($request->input('field_visit_category_id')) {
            $fv_report->field_visit_category_id = $request->input('field_visit_category_id');
        }

        if ($request->input('field_visit_other_category')) {
            $fv_report->field_visit_other_category = $request->input('field_visit_other_category');
        }

        if ($request->input('details_findings')) {
            $fv_report->details_findings = $request->input('details_findings');
        }

        if ($request->input('summary')) {
            $fv_report->summary = $request->input('summary');
        }

        if ($request->input('remarks')) {
            $fv_report->remarks = $request->input('remarks');
        }

        if ($request->input('report_by_name_1')) {
            $fv_report->report_by_name_1 = $request->input('report_by_name_1');
        }

        if ($request->input('report_by_name_1_date')) {
            $fv_report->report_by_name_1_date = $request->input('report_by_name_1_date');
        }

        if ($request->input('report_by_name_2')) {
            $fv_report->report_by_name_2 = $request->input('report_by_name_2');
        }

        if ($request->input('report_by_name_2_date')) {
            $fv_report->report_by_name_2_date = $request->input('report_by_name_2_date');
        }

        if ($request->input('report_by_name_3')) {
            $fv_report->report_by_name_3 = $request->input('report_by_name_3');
        }

        if ($request->input('report_by_name_3_date')) {
            $fv_report->report_by_name_3_date = $request->input('report_by_name_3_date');
        }

        if ($request->input('status')) {
            $fv_report->status = $request->input('status');
        }

        if ($fv_report->save())
        {
            $fv_report_id = $fv_report->id;

            if ($request->hasFile('report_by_name_1_signature'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign1';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('report_by_name_1_signature');
                $path = $file->store($storage_directoryPath);
                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;
                $fv_report->report_by_name_1_signature = $db_path;
                $fv_report->save();
            }

            if ($request->hasFile('report_by_name_2_signature'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign2';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('report_by_name_2_signature');
                $path = $file->store($storage_directoryPath);
                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;
                $fv_report->report_by_name_2_signature = $db_path;
                $fv_report->save();
            }

            if ($request->hasFile('report_by_name_3_signature'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign3';
                $storage_directoryPath = 'public'.$storage_content_directoryPath;

                Storage::deleteDirectory($storage_directoryPath);

                //Check is directory exists
                if(!Storage::exists($storage_directoryPath))
                {
                    // Generate the files
                    Storage::makeDirectory($storage_directoryPath);
                }

                $file = $request->file('report_by_name_3_signature');
                $path = $file->store($storage_directoryPath);
                $path = str_replace("public","storage",$path);
                $db_path = $host_url.'/'.$path;
                $fv_report->report_by_name_3_signature = $db_path;
                $fv_report->save();
            }

            if ($request->hasFile('pic_1'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic1';
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
                $fv_report->pic_1 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_2'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic2';
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
                $fv_report->pic_2 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_3'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic3';
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
                $fv_report->pic_3 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_4'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic4';
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
                $fv_report->pic_4 = encrypt($db_path);
                $fv_report->save();
            }

            if ($request->hasFile('pic_5'))
            {
                $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic5';
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
                $fv_report->pic_5 = encrypt($db_path);
                $fv_report->save();
            }

            $data = array(
               'report_id' => decrypt($fv_report->report_no),
               'submit_date' => decrypt($fv_report->submit_date),
               'submit_to' => decrypt($fv_report->submit_to),
               'system' => decrypt($fv_report->system),
               'visiting_date' => decrypt($fv_report->visiting_date),
               'visiting_time' => decrypt($fv_report->visiting_time),
               'details_findings'  => decrypt($fv_report->details_findings),
               'summary'  => decrypt($fv_report->summary),
               'report_by_name_1'  => decrypt($fv_report->report_by_name_1),
               'report_by_name_1_date'  => decrypt($fv_report->report_by_name_1_date),
               'report_by_name_1_signature'  => decrypt($fv_report->report_by_name_1_signature),
               'status' => decrypt($fv_report->status),
            );

            if ($fv_report->location) {
                $data['location']  = decrypt($fv_report->location);
            }

            if ($fv_report->location_id) {
                $location = Location::findOrFail( decrypt($fv_report->location_id));
                $data['location']  = $location->location_name;
            }

            if ($fv_report->field_visit_category_id) {
                $id = decrypt($fv_report->field_visit_category_id);
                $category = FieldVisitCategory::findOrFail($id);

                $data['category']  = $category->category_name;
            }

            if ($fv_report->field_visit_other_category) {
                $data['category']  = decrypt($fv_report->field_visit_other_category);
            }

            if ($fv_report->report_by_name_2) {
                $data['report_by_name_2']  = decrypt($fv_report->report_by_name_2);
            }
            else
            {
                $data['report_by_name_2']  = null;
            }

            if ($fv_report->report_by_name_2_date) {
                $data['report_by_name_2_date']  = decrypt($fv_report->report_by_name_2_date);
            }

            if ($fv_report->report_by_name_2_signature) {
                $data['report_by_name_2_signature']  = decrypt($fv_report->report_by_name_2_signature);
            }

            if ($fv_report->report_by_name_3) {
                $data['report_by_name_3']  = decrypt($fv_report->report_by_name_3);
            }
            else
            {
                $data['report_by_name_3']  = null;
            }

            if ($fv_report->report_by_name_3_date) {
                $data['report_by_name_3_date']  = decrypt($fv_report->report_by_name_3_date);
            }

            if ($fv_report->report_by_name_3_signature) {
                $data['report_by_name_3_signature']  = decrypt($fv_report->report_by_name_3_signature);
            }

            if ($fv_report->pic_1) {
                $data['pic_1']  = decrypt($fv_report->pic_1);
            }

            if ($fv_report->pic_2) {
                $data['pic_2']  = decrypt($fv_report->pic_2);
            }

            if ($fv_report->pic_3) {
                $data['pic_3']  = decrypt($fv_report->pic_3);
            }

            if ($fv_report->pic_4) {
                $data['pic_4']  = decrypt($fv_report->pic_4);
            }

            if ($fv_report->pic_5) {
                $data['pic_5']  = decrypt($fv_report->pic_5);
            }

            $this->sendMailToMailList($data);

        }

        return response()->json(['success' => new FieldVisitResource($fv_report)], Response::HTTP_CREATED);
    }


    private function sendMailToMailList($data)
    {
        $allmails = MailList::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('emails.reportservices.fieldvisitservice.fieldVisitReport', compact('data'))->setPaper('a4')->setWarnings(false);

        foreach($allmails as $mail_index => $mail_props) {

            Mail::to($allmails[$mail_index]->mail_email)
                ->send(new FieldVisitReportMail($data, $pdf->output()), $data,
                    function ($message) use ($data) {
                        // $message->from('test@test.com', 'Test');
                        // $message->to('foo@example.com')->cc('bar@example.com');

                        // $message->attachData($pdf->output(), 'filename.pdf');
                    });
        }
    }

    private function sendNotification($admins, $data) {
        // local database notifications
        Notification::send($admins, new ReportServiceNotification($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new FieldVisitResource(FieldVisitService::findOrFail($id));
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
        $fv_report = FieldVisitService::findOrFail($id);
        $fv_report_id = $fv_report->id;
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {

                if ($attribute == 'report_by_name_1_signature') {
                    if ($request->hasFile('report_by_name_1_signature'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign1';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('report_by_name_1_signature');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fv_report->report_by_name_1_signature = encrypt($db_path);
                        $fv_report->save();
                    }
                }
                elseif ($attribute == 'report_by_name_2_signature') {
                    if ($request->hasFile('report_by_name_2_signature'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign2';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('report_by_name_2_signature');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fv_report->report_by_name_2_signature = encrypt($db_path);
                        $fv_report->save();
                    }
                }

                elseif ($attribute == 'report_by_name_3_signature') {
                    if ($request->hasFile('report_by_name_3_signature'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/sign3';
                        $storage_directoryPath = 'public'.$storage_content_directoryPath;

                        Storage::deleteDirectory($storage_directoryPath);

                        //Check is directory exists
                        if(!Storage::exists($storage_directoryPath))
                        {
                            // Generate the files
                            Storage::makeDirectory($storage_directoryPath);
                        }

                        $file = $request->file('report_by_name_3_signature');
                        $path = $file->store($storage_directoryPath);
                        $path = str_replace("public","storage",$path);
                        $db_path = $host_url.'/'.$path;
                        $fv_report->report_by_name_3_signature = encrypt($db_path);
                        $fv_report->save();
                    }
                }
                elseif ($attribute == 'pic_1') {
                    if ($request->hasFile('pic_1'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic1';
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
                        $fv_report->pic_1 = encrypt($db_path);
                        $fv_report->save();
                    }
                }

                elseif ($attribute == 'pic_2') {
                    if ($request->hasFile('pic_2'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic2';
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
                        $fv_report->pic_2 = encrypt($db_path);
                        $fv_report->save();
                    }
                }

                elseif ($attribute == 'pic_3') {
                    if ($request->hasFile('pic_3'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic3';
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
                        $fv_report->pic_3 = encrypt($db_path);
                        $fv_report->save();
                    }
                }

                elseif ($attribute == 'pic_4') {
                    if ($request->hasFile('pic_4'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic4';
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
                        $fv_report->pic_4 = encrypt($db_path);
                        $fv_report->save();
                    }
                }

                elseif ($attribute == 'pic_5') {
                    if ($request->hasFile('pic_5'))
                    {
                        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id.'/pic5';
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
                        $fv_report->pic_5 = encrypt($db_path);
                        $fv_report->save();
                    }
                }

                else {
                    $fv_report->$attribute = encrypt($credentials[$attribute]);
                }
            }

            $fv_report->updated_by = $user_id;
            $fv_report->save();

            $commzGate = new CommzGateServices();
            $report_no = decrypt($fv_report->report_no);
            $admins = User::where('user_group_id', 1)->get();

            foreach($admins as $admin) {
                $receiver_number = $admin->contact;
                $message = '*FVS* '.$user->full_name.' ('.$user->id.') had updated FVS report - ('.$report_no.') at '.$fv_report->updated_at.'' ;

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
                    $new_sms->receiver_id = $admin->id;
                    $new_sms->receiver_number = $receiver_number;
                    $new_sms->message = $message;
                    $new_sms->msg_response_code = $successCode;
                    $new_sms->commzgate_msg_id = $parts[1];
                    $new_sms->save();
                }
            }

            // Notification
            $data = array(
               'report_id' => decrypt($fv_report->report_no)
            );
            $data['report_type'] = 'FVS';
            $data['link'] = '/reportservices/frs?report_no='.$data['report_id'].'';
            $data['submitted_by'] = $user->full_name;
            $data['submitted_by_id'] = $user->id;
            $data['created_at'] = $fv_report->created_at;
            $data['form_action_title'] = 'Updated of FVS';
            $data['form_action'] = 'updated';
            $data['notification_theme_color'] = 'cyan';
            $data['notification_icon'] = 'assessment';
            $this->sendNotification($admins, $data);

            return response()->json(['updated' => new FieldVisitResource($fv_report)], Response::HTTP_CREATED);
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
        $host_url = env('DOMAIN_URL');
        $fv_report = FieldVisitService::findOrFail($id);

        $fv_report_id = $fv_report->id;

        $storage_content_directoryPath = '/images/reportservices/fv/fv-'.$fv_report_id;
        $storage_directoryPath = 'public'.$storage_content_directoryPath;

        Storage::deleteDirectory($storage_directoryPath);

        $fv_report->delete();

        return response()->json(['deleted' => $fv_report], Response::HTTP_CREATED);
    }
}
