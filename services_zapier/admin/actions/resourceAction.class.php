<?php

use OAuth2\Request;
use OAuth2\Response;

require_once __DIR__ . "/../../common/vendor/autoload.php";


class services_zapier_resourceAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = Request::createFromGlobals();
        $oauthResponse = new Response();

        if (!$server->verifyResourceRequest($oauthRequest, $oauthResponse)) {
            $oauthResponse->send();
            exit;
        }

        $tokenData = $server->getAccessTokenData($oauthRequest);

        return array('success' => true, 'message' => 'Données protégées'.$tokenData['user_id']);

    }
}
