<?php

namespace App\Services;


class SMSService
{
    public static function sendSms($phoneno, $messageBody)
    {
        $url = "http://103.53.84.15:8746/sendtext?apikey=65cd109fd5735a24&secretkey=c52ff920&callerID=8801847&toUser=88" . $phoneno . "&messageContent=" . urlencode($messageBody);
        return Self::smsApi($url);
    }

    public static function smsApi($url)
    {
        //return $url;
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
