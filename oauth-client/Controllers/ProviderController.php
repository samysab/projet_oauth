<?php


namespace App\Controller;


abstract class ProviderController
{

    final public function templateMethod(): void
    {
    	$this->handleLogin();
    }

    protected function handleLogin(): void
    {
    	echo "Login";
    }


    // abstract protected function handleError(): void;

    abstract protected function handleSuccess(): void;

}