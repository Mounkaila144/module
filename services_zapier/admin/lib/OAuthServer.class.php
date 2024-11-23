<?php
require_once __DIR__ . "/../../common/vendor/autoload.php";

use OAuth2\Server;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\RefreshToken;

class OAuthServer
{
    protected $server;

    public function __construct()
    {
        $clientStorage = new ClientStorage();

        $storage = array(
            'client'    => $clientStorage,// ICI
            'client_credentials' => $clientStorage, //Fournir explicitement un storage client_credentials et l'associer au ClientStorage que vous avez créé plus haut
            'authorization_code'    => new AuthCodeStorage(),
            'access_token'          => new AccessTokenStorage(),
            'refresh_token'         => new RefreshTokenStorage(),
            // 'user_credentials'      => new UserStorage(),
            'scope'                 => new ScopeStorage(),
        );


        // Créer le serveur OAuth2 avec les stockages
        $this->server = new Server($storage);

        // Ajouter les types de grants que vous souhaitez prendre en charge
        $this->server->addGrantType(new AuthorizationCode($storage['authorization_code']));
        $this->server->addGrantType(new RefreshToken($storage['refresh_token']));
    }

    public function getServer()
    {
        return $this->server;
    }
}
