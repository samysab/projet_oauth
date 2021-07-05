<?php


namespace App\Controller;

class FacebookController extends ProviderController{

	private $code = "fdzefzefze";
	private $state = "fdzefzefze";

	public function handleSuccess(): void
	{
	    $this->state = $_GET["state"];
	    $this->code = $_GET["code"];
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



    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     *
     * @return self
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}