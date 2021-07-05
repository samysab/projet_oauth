<?php


namespace App\Controller;


abstract class ProviderController
{


    /**
     * The template method defines the skeleton of an algorithm.
     */
    final public function templateMethod(): void
    {
    	$this->handleLogin();
        $this->handleSuccess();

    }

    protected function handleLogin(){
	    // http://.../auth?response_type=code&client_id=...&scope=...&state=...
	    echo "<h1>Login with OAUTH</h1>";
	    echo "<a href='http://localhost:8081/auth?response_type=code"
	        . "&client_id=" . CLIENT_ID
	        . "&scope=basic"
	        . "&state=" . STATE . "'>Se connecter avec Oauth Server</a>";
	    echo "<a href='https://www.facebook.com/v2.10/dialog/oauth?response_type=code"
	        . "&client_id=" . CLIENT_FBID
	        . "&scope=email"
	        . "&state=" . STATE
	        . "&redirect_uri=https://localhost/fbauth-success'>Se connecter avec Facebook</a>";

	    echo "<a href='https://github.com/login/oauth/authorize?response_type=code"
	        . "&client_id=" . CLIENT_GITID
	        . "&state=" . STATE
	        . "&redirect_uri=https://localhost/gitauth-success'>Se connecter avec Github</a>";
	}


    // abstract protected function handleError(): void;

    abstract protected function handleSuccess(): void;

    // abstract protected function getUser(): void;


}