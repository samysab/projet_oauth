<?php


namespace App\Controller;

class FacebookController extends ProviderController{

	public function handleSuccess(): void
	{
	    ["state" => $state, "code" => $code] = $_GET; 
	    if ($state !== STATE) {
	        throw new \RuntimeException("{$state}: invalid state");
	    }
	    // https://auth-server/token?grant_type=authorization_code&code=...&client_id=..&client_secret=...
	    $url = "https://graph.facebook.com/oauth/access_token?grant_type=authorization_code&code={$code}&client_id=" . CLIENT_FBID . "&client_secret=" . CLIENT_FBSECRET."&redirect_uri=https://localhost/fbauth-success";
	    $result = file_get_contents($url);
	    $resultDecoded = json_decode($result, true);
	    ["access_token"=> $token] = $resultDecoded;
	    $userUrl = "https://graph.facebook.com/me?fields=id,name,email";
	    $context = stream_context_create([
	        'http' => [
	            'header' => 'Authorization: Bearer ' . $token
	        ]
	    ]);
	    echo file_get_contents($userUrl, false, $context);
	}

}