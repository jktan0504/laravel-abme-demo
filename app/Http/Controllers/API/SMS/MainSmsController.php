<?php

namespace App\Http\Controllers\API\SMS;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Lib\CommzGate\CommzGateServices;

use App\Models\SMS\Sms;
use App\Http\Requests\Sms\SendSmsRequest;
use App\Http\Resources\Sms\SmsResource;

class MainSmsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receiveAllMessagesFromMode(Request $request)
    {
        $commzGate = new CommzGateServices();
        $receive_mode = $request->input('receive_mode');

        $responseFull = $commzGate->receivedAllMessages(
            $receive_mode
        );

        return response()->json(['success' => $responseFull], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendToSingleReceipientMsg(Request $request)
    {
        $commzGate = new CommzGateServices();
        $receipient_telephone = $request->input('telephone_no');
        $messages = $request->input('sms_message');

        $responseFull = $commzGate->sendToOneReceipient(
            $receipient_telephone,
            $messages
        );

        $result = $responseFull->original['success']['code'];

        return response()->json(['success' => $result], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendToStationMaster(SendSmsRequest $request)
    {
        $sender = Auth::user();
        $sender_id = $sender->id;

        $receiver_number = $request->input('receiver_number');
        $message = $request->input('message');
        $formattedMessage = preg_replace('/\s+/', "+", $message);

        $commzGate = new CommzGateServices();

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
            $new_sms->sender_id = $sender_id;

            if ($request->input('receiver_id')) {
                $new_sms->receiver_id = $request->input('receiver_id');
            }

            // seldom use for recording the sender number
            if ($request->input('sender_number')) {
                $new_sms->sender_number = $request->input('sender_number'); // sender_number (always is server)
            }

            $new_sms->receiver_number = $receiver_number;
            $new_sms->message = $message;

            if ($request->input('remarks')) {
                $new_sms->remarks = $request->input('remarks');
            }

            $new_sms->msg_response_code = $successCode;
            $new_sms->commzgate_msg_id = $parts[1];
            $new_sms->save();
        }

        return response()->json(['success' => $new_sms], Response::HTTP_CREATED);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        if ($request->input('commzgate_msg_id')) {
            $commzgate_msg_id = $request->input('commzgate_msg_id');

            $sms =  Sms::where('commzgate_msg_id', $commzgate_msg_id)
                    ->with('user')
                    ->orderBy('id','desc')
                    ->paginate($per_page);
        }
        else {
            $sms = Sms::with('user')
                ->orderBy('id','desc') 
                ->paginate($per_page);
        }

        return SmsResource::collection($sms);
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
    public function destroy($id)
    {
        $sms = Sms::findOrFail($id);
        $sms->delete();

        return response()->json(['deleted' => $sms], Response::HTTP_CREATED);
    }
}
