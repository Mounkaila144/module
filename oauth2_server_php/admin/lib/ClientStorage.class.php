<?php

use OAuth2\Storage\ClientCredentialsInterface;
use OAuth2\Storage\ClientInterface;
require_once __DIR__ . "/../../common/vendor/autoload.php";

class ClientStorage implements ClientInterface, ClientCredentialsInterface // Implementer ClientCredentialsInterface
{
    public function getClientDetails($client_id)
    {
        $client = new Oauth2ServerPhpClient();
        $client->loadByClientId($client_id);
        if ($client->isLoaded()) {
            return array(
                'client_id'     => $client->get('client_id'),
                'client_secret' => $client->get('client_secret'),
                'redirect_uri'  => $client->get('redirect_uri'),
                'grant_types'   => $client->get('grant_types'),
                'scope'         => $client->get('scope'),
                'user_id'       => $client->get('user_id'),
            );
        }
        return false;
    }

    public function checkRestrictedGrantType($client_id, $grant_type)
    {
        $clientDetails = $this->getClientDetails($client_id);
        if (isset($clientDetails['grant_types'])) {
            $grantTypes = explode(' ', $clientDetails['grant_types']);
            return in_array($grant_type, $grantTypes);
        }
        // Par défaut, autoriser tous les types de grants
        return true;
    }
    public function checkClientCredentials($client_id, $client_secret = null)
    {
        $client = new Oauth2ServerPhpClient();
        $client->loadByClientId($client_id);
        if ($client->isLoaded()) {
            return $client->get('client_secret') === $client_secret;
        }
        return false;
    }
    // Autres méthodes si nécessaire (par exemple, getClientScope)
    public function getClientScope($client_id)
    {
        // TODO: Implement getClientScope() method.
    }

    public function isPublicClient($client_id)
    {
        // TODO: Implement isPublicClient() method.
    }
}
