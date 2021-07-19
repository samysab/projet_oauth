<?php


namespace App\Controller;

use App\Core\Helpers;

class GmailController extends ProviderController
{
    public function handleLogin(): void{
        echo "<a href='https://accounts.google.com/o/oauth2/v2/auth?"
            ."scope=https%3A//www.googleapis.com/auth/drive.metadata.readonly&"
            ."access_type=offline&include_granted_scopes=true&response_type=code"
            . "&state=" . STATE
            . "&redirect_uri=https://localhost/gmailauth-success"
            ."&client_id=" . CLIENT_GMAILID ."'>Se connecter avec Gmail</a>";
    }

    public function handleSuccess(): void
    {
        require_once 'google-api-php-client/vendor/autoload.php';

        $client = new \Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->setRedirectUri('https://localhost/gmailauth-success');
        $client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);

        if (! isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            echo '<pre>';
            var_dump($_SESSION['access_token']);
        }
    }
}