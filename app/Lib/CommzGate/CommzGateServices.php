<?php
namespace App\Lib\CommzGate;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class CommzGateServices {

    private $_commzGateAPIDomain;
    private $_accessToken;
    private $_collectionID;
    private $_secret_key;
    private $_sneapy_api_domain;
    private $_sneapy_api_version;

    // Constructor
    public function __construct()
    {
        $this->_commzGateAPIDomain = env('COMMZGATE_API_DOMAIN');

        $this->_accessToken = env('COMMZGATE_ACCESS_TOKEN');
    }

    // Send to one recipient
    public function sendToOneReceipient($receipient_telephone, $messages) {

        $url = $this->_commzGateAPIDomain.'/commzgate/servlet/commz.servlet.SendMsg?token='
                .$this->_accessToken.'&mobile='.$receipient_telephone.'&&message='.$messages.'';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                "Content-Type: application/x-www-form-urlencoded;charset=\"utf-8\""
            ),

        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $result['url'] = $url;
        $result['code'] = $response;
        if ($err) {
            return response()->json(['failed' => $err], 200);
        } else {
            $json_object = json_decode($response);
            $result['json'] = $json_object;
            return response()->json(['success' => $result], 200);
            // print_r(response()->json($json_object));
        }
    }

    // Receive Message
    public function receivedAllMessages($receive_mode) {

        $url = $this->_commzGateAPIDomain.'/commzgate/servlet/commz.httpapi.RcvMsg?token='
                .$this->_accessToken.'&mode='.$receive_mode.'';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                "Content-Type: application/x-www-form-urlencoded;charset=\"utf-8\""
            ),

        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $result['url'] = $url;
        $result['code'] = $response;
        if ($err) {
            return response()->json(['failed' => $err], 200);
        } else {
            $json_object = json_decode($response);
            $result['json'] = $json_object;
            return response()->json(['success' => $result], 200);
            // print_r(response()->json($json_object));
        }
    }
}
