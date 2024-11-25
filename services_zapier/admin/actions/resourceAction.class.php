<?php

class services_zapier_resourceAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = OAuth2Request::createFromGlobals();
        $oauthResponse = new OAuth2Response();

        if (!$server->verifyResourceRequest($oauthRequest, $oauthResponse)) {
            $oauthResponse->send();
            exit;
        }

        $tokenData = $server->getAccessTokenData($oauthRequest);

        return array('success' => true, 'message' => 'Données protégées'.$tokenData['user_id']);

    }
}
