<?php

ini_set("display_errors", true);
session_start();

include 'Controllers/ProviderController.php';
include 'Controllers/FacebookController.php';
include 'Controllers/GithubController.php';
include 'Controllers/OauthController.php';
include 'Controllers/GmailController.php';
include 'Core/Helpers.php';

include "./config.php";

use App\Controller\FacebookController;
use App\Controller\GithubController;
use App\Controller\OauthController;
use App\Controllers\GmailController;

$providerFb = new FacebookController();
$providerGit = new GithubController();
$providerOauth = new OauthController();
$providerGmail = new \App\Controller\GmailController();

/**
 * AUTH CODE WORKFLOW
 * => Generate link (/login)
 * => Get Code (/auth-success)
 * => Exchange Code <> Token (/auth-success)
 * => Exchange Token <> User info (/auth-success)
 */
$route = strtok($_SERVER["REQUEST_URI"], "?");
switch ($route) {
    case '/login':
        $providerOauth->templateMethod();
        $providerFb->templateMethod();
        $providerGit->templateMethod();
        $providerGmail->templateMethod();
        break;
    case '/auth-success':
        $providerOauth->handleSuccess();
        break;
    case '/fbauth-success':
        $providerFb->handleSuccess();
        break;
    case '/gitauth-success':
        $providerGit->handleSuccess();
        break;
    case '/gmailauth-success':
        $providerGmail->handleSuccess();
        break;
    case '/auth-cancel':
        handleError();
        break;
    case '/password':
        $providerOauth->pwdForm();
        break;
    default:
        http_response_code(404);
        break;
}