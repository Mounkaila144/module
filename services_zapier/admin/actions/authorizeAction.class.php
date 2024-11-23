<?php

use OAuth2\Request;
use OAuth2\Response;

require_once __DIR__ . "/../../common/vendor/autoload.php";



class services_zapier_authorizeAction extends mfAction
{
    public function execute(mfWebRequest $request)
    {
        $oauthServer = new OAuthServer();
        $server = $oauthServer->getServer();

        $oauthRequest = Request::createFromGlobals();
        $oauthResponse = new Response();

        // Vérifier la requête d'autorisation
        if (!$server->validateAuthorizeRequest($oauthRequest, $oauthResponse)) {
            $oauthResponse->send();
            exit;
        }

        // Vérifier si l'utilisateur est authentifié
        if (!$this->getUser()->isAuthenticated()) {
            $this->getUser()->getStorage()->write('oauth2_server_request',$oauthRequest->query);
            $this->redirect('/admin');
            exit;
        }

        if ($request->isMethod('post')) {
            // L'utilisateur a soumis le formulaire
            $isAuthorized = ($request->getPostParameter('approve') === 'yes');
            $userId = $this->getUser()->getGuardUser()->get('id');

            $server->handleAuthorizeRequest($oauthRequest, $oauthResponse, $isAuthorized, $userId);

            if ($isAuthorized) {
                $oauthResponse->send();
                exit;
            } else {
                // L'utilisateur a refusé l'accès
                $this->forward404('Access denied');
            }
        } else {
            // Afficher le formulaire d'autorisation
            $this->client = new ServicesZapierClient($oauthRequest->query['client_id']);

            $this->defaultClientScopes = explode(' ', $this->client->get('scope'));
        }
    }
}
