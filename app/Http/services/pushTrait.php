<?php

namespace App\Http\services;

trait pushTrait
{

    public function send_notification($title,$body ,$notification ,$userToken){
        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default"
        );

        $fcmFields = array(
            'registration_ids' => $userToken,
            'priority' => 'high',
            'content_available' => true,
            'mutable_content' => false,
            'notification' => $fcmMsg,
            'data' => $notification
        );
        $API_ACCESS_KEY='AAAAre3RJU8:APA91bHeonKredCDpy_HnNYl07_MLz4VAS8UnOzHCYrw6AacgtWu7YndAQx-gFPnIlSBoJTNtGM9UvEpU9ExwnGFmzSnOsq5lvHPLQFjJCigOv9YgZpz2xRczfxL2V4sQmgH5wHf8uEX';
        $headers = array(
            'Authorization: key=' . env('FCM_SERVER_KEY',$API_ACCESS_KEY),
            'Content-Type: application/json'
        );
        $req = json_encode($fcmFields,true);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $response_data = curl_exec($ch);
        curl_close($ch);
        $response_data = json_decode($response_data, true);
        return $response_data;
    }
}
