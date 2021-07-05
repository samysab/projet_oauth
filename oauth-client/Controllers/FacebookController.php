<?php


namespace App\Controller;

class FacebookController extends ProviderController{

	private $code = "60a3919d567a1";
	private $state = "fdzefzefze";

	public function handleSuccess(): void
	{
	    $_GET["state"] = $this->state ;
	    $_GET["code"] = $this->code;
	    if ($this->state !== STATE) {
	        throw new \RuntimeException("{$this->state}: invalid state");
	    }
	    // https://auth-server/token?grant_type=authorization_code&code=...&client_id=..&client_secret=...
	    $url = "https://graph.facebook.com/oauth/access_token?grant_type=authorization_code&code={$this->code}&client_id=" . CLIENT_FBID . "&client_secret=" . CLIENT_FBSECRET."&redirect_uri=https://localhost/fbauth-success";
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