<?php


namespace App\Controller;

class GithubController extends ProviderController{

	protected function handleSuccess(): void
	{
	    ["state" => $state, "code" => $code] = $_GET;
	    if ($state !== STATE) {
	        throw new RuntimeException("{$state} : invalid state");
	    }
	    $url ="https://github.com/login/oauth/access_token";
	    $apiURLBase = 'https://api.github.com';
	    // Exchange the auth code for a token
	    $token = apiRequest($url, array(
	        'client_id' => CLIENT_GITID,
	        'client_secret' => CLIENT_GITSECRET,
	        'redirect_uri' => "https://localhost/gitauth-success",
	        'state' => $state,
	        'User-Agent' => APP_NAME,
	        'code' => $code
	    ));

	    $_SESSION['access_token'] = $token->access_token;

	    if(session('access_token')) {
	        $response = apiRequest($apiURLBase. '/user');
	        echo '<h3>Logged In</h3>';
	        echo '<pre>';
	        print_r($response);
	        echo '</pre>';
	    } else {
	        echo '<h3>Not logged in</h3>';
	        echo '<p><a href="?action=login">Log In</a></p>';
	    }
	}
}