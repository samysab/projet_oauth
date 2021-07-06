<?php

ini_set("display_errors", true);
session_start();

include 'Controllers/ProviderController.php';
include 'Controllers/FacebookController.php';
include 'Controllers/GithubController.php';
include 'Controllers/OauthController.php';
include 'Core/Helpers.php';

include "./config.php";

use App\Controller\FacebookController;
use App\Controller\GithubController;
use App\Controller\OauthController;


$provider = new GithubController();

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
        $provider->templateMethod();
        break;
    case '/auth-success':
        $provider->handleSuccess();
        break;
    case '/fbauth-success':
        $provider->handleSuccess();
        break;
    case '/gitauth-success':
        $provider->handleSuccess();
        break;
    case '/auth-cancel':
        handleError();
        break;
    case '/password':
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo '<form method="POST">';
            echo '<input name="username">';
            echo '<input name="password">';
            echo '<input type="submit" value="Submit">';
            echo '</form>';
        } else {
            ["username" => $username, "password" => $password] = $_POST;
            getUser([
                'grant_type' => "password",
                "username" => $username,
                "password" => $password
            ]);
        }
        break;
    default:
        http_response_code(404);
        break;
}
