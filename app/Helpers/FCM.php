<?php

namespace App\Helpers;


class FCM{

    public static function push($tokens,$title, $message ,$date)
    {
    	$notification = [
		    'body' 	=> $message,
		    'title'	=> $title,
            'icon'	=> 'myicon',
            'sound' => 'default',
			'date'  => $date,
            'badge' => '1',
			
        ];

    	$fields = [
			'registration_ids' => $tokens,
			'priority' => "high",
			'notification' => $notification
        ];

		$headers = [
			'Authorization: key=' . env('FCM_KEY'),
			'Content-Type: application/json'
		];

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		return $result;
    }

   
}
