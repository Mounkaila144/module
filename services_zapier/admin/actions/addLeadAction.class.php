<?php

use OAuth2\Request;
use OAuth2\Response;

require_once __DIR__ . "/../../common/vendor/autoload.php";


class services_zapier_addLeadAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = Request::createFromGlobals();
        $oauthResponse = new Response();

        // Vérification du token d'accès
        if (!$server->verifyResourceRequest($oauthRequest, $oauthResponse)) {
            $oauthResponse->send();
            exit;
        }

        return json_encode(['success' => true, 'data' => $oauthRequest->request]);
    }
}
