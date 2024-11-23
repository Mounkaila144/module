<?php

use OAuth2\Request;

require_once __DIR__ . "/../../common/vendor/autoload.php";

class services_zapier_refreshTokenAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = Request::createFromGlobals(); // Important : utiliser createFromGlobals() pour gérer les requêtes POST
        $oauthResponse = $server->handleTokenRequest($oauthRequest);

        $oauthResponse->send();
        exit;
    }
}