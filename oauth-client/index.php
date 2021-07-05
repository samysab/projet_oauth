<?php

ini_set("display_errors", true);

include 'Controllers/ProviderController.php';
include 'Controllers/FacebookController.php';
include 'Controllers/GithubController.php';


const CLIENT_ID = "client_60a3778e70ef02.05413444";
const CLIENT_FBID = "478489700258105";
const CLIENT_GITID = "5c0ee32c7724b006861e";
const CLIENT_SECRET = "cd989e9a4b572963e23fe39dc14c22bbceda0e60";
const CLIENT_FBSECRET = "bb98e62cd4229c0760838d8cbfe45ca9";
const CLIENT_GITSECRET = "cbfd0ad257e783da29ed90a6d8531e364c4d7af";
const STATE = "fdzefzefze";
const APP_NAME = "GH WHATEVER";

use App\Controller\FacebookController;
use App\Controller\GithubController;

function clientCode($class)
{
    // ...
    $class->templateMethod();
    // ...
}

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
        clientCode(new FacebookController);
        break;
    case '/auth-success':
        handleSuccess();
        break;
    case '/fbauth-success':
        handleFbSuccess();
        break;
    case '/gitauth-success':
        handleGitSuccess();
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
