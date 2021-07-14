<?php

namespace App\Core;

class Helpers{

	public static function session($key, $default=NULL){
	    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
	}

	public static function apiRequest($url, $post=FALSE, $headers=array())
	{
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    if($post)
	        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	    $headers[] = 'Accept: application/json';
	    if(self::session('access_token'))
	        $headers[] = 'Authorization: Bearer ' . self::session('access_token');
	    $headers[] = 'User-Agent:' . APP_NAME;
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    $response = curl_exec($ch);
	    return json_decode($response, true);
	}

}