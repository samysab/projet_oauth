<?php


namespace App\Controller;

class OauthController extends ProviderController{

	public function handleLogin(): void
	{
	    // http://.../auth?response_type=code&client_id=...&scope=...&state=...
	    echo "<h1>Login with OAUTH</h1>";
	    echo "<a href='http://localhost:8081/auth?response_type=code"
	        . "&client_id=" . CLIENT_ID
	        . "&scope=basic"
	        . "&state=" . STATE . "'>Se connecter avec Oauth Server</a>";
	}

	public function handleError()
	{
	    ["state" => $state] = $_GET;
	    echo "{$state} : Request cancelled";
	}

	public function handleSuccess(): void
	{
	    ["state" => $state, "code" => $code] = $_GET;
	    if ($state !== STATE) {
	        throw new RuntimeException("{$state} : invalid state");
	    }
	    // https://auth-server/token?grant_type=authorization_code&code=...&client_id=..&client_secret=...
	    $this->getUser([
	        'grant_type' => "authorization_code",
	        "code" => $code,
	    ]);
	}

	public function getUser($params)
	{
	    $url = "http://oauth-server:8081/token?client_id=" . CLIENT_ID . "&client_secret=" . CLIENT_SECRET . "&" . http_build_query($params);
	    $result = file_get_contents($url);
	    $result = json_decode($result, true);
	    $token = $result['access_token'];

	    $apiUrl = "http://oauth-server:8081/me";
	    $context = stream_context_create([
	        'http' => [
	            'header' => 'Authorization: Bearer ' . $token
	        ]
	    ]);
	    echo file_get_contents($apiUrl, false, $context);
	}

}