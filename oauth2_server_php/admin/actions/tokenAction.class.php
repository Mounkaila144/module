<?php

use OAuth2\Request;

require_once __DIR__ . "/../../common/vendor/autoload.php";


class oauth2_server_php_tokenAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = OAuth2Request::createFromGlobals();
        $oauthResponse = $server->handleTokenRequest($oauthRequest);

        $oauthResponse->send();
        exit;
    }
}
