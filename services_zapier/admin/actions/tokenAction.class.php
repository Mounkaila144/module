<?php

use OAuth2\Request;

require_once __DIR__ . "/../../common/vendor/autoload.php";


class services_zapier_tokenAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = Request::createFromGlobals();
        $oauthResponse = $server->handleTokenRequest($oauthRequest);

        $oauthResponse->send();
        exit;
    }
}
