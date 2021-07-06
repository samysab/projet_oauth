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
    }

    protected function handleLogin(): void
    {
    	echo "Login";
    }


    // abstract protected function handleError(): void;

    abstract protected function handleSuccess(): void;

}