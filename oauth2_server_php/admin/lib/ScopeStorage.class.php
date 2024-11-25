<?php
use OAuth2\Storage\ScopeInterface;

class ScopeStorage implements ScopeInterface
{
    public function scopeExists($scope)
    {
        $scopeList = explode(' ', $scope);
        foreach ($scopeList as $s) {
            $scopeObj = new Oauth2ServerPhpScope();
            $scopeObj->loadByScope($s);
            if (!$scopeObj->isLoaded()) {
                return false;
            }
        }
        return true;
    }

    public function getDefaultScope($client_id = null)
    {
        // Retourner le scope par défaut
        return 'default';
    }
    public function getScopeFromAccessToken($access_token) {
        //Votre logique pour extraire les scopes du token access (si pertinent avec vos grant types utilisés).
    }



    /**
     * Récupérer le Scope d'un code d'autorisation. Obligatoire pour le "Auth Code Grant"
     **/
    public function getScopeFromAuthorizationCode($authorization_code) {

        $authCode = new Oauth2ServerPhpAuthCode();
        $authCode->loadByCode($authorization_code);
        if ($authCode->isLoaded()) {
            return $authCode->getAssociatedScopes(); // ou un appel à votre base de données pour extraire les scopes
        }
        return false;

    }





    /**
     * Utilisé pour valider les scopes avec une requête (auth code et implicit grants).
     * Peut aussi être appelé par le contrôleur de ressources
     * pour vérifier l'autorisation d'accès au scope sur une requête de ressource.
     **/
    public function checkScope($token, $scope) {
        $tokenScopes = explode('|', $token['scope']);

        $requiredScopes = explode(' ', $scope); //si plusieurs scope demandé, séparés par espaces.

        foreach($requiredScopes as $required) {

            if(!in_array($required,$tokenScopes))
                return false; // scope pas present sur le token
        }

        return true;

    }
}
