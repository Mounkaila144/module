<?php
use OAuth2\Storage\AuthorizationCodeInterface;

class AuthCodeStorage implements AuthorizationCodeInterface
{
    public function getAuthorizationCode($code)
    {
        $authCode = new Oauth2ServerPhpAuthCode($code);

        if ($authCode->isLoaded()) {
            return array(
                'authorization_code' => $authCode->get('authorization_code'),
                'client_id'          => $authCode->get('client_id'),
                'user_id'            => $authCode->get('user_id'),
                'redirect_uri'       => $authCode->get('redirect_uri'),
                'expires'            => strtotime($authCode->get('expires')),
                'scope'              => $authCode->get('scope'),
            );
        }
        return false;
    }

    public function setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = null)
    {

        $authCode = new Oauth2ServerPhpAuthCode();
        $authCode->add(array(
            'authorization_code' => $code,
            'client_id'          => $client_id,
            'user_id'            => $user_id,
            'redirect_uri'       => $redirect_uri,
            'expires'            => date('Y-m-d H:i:s', $expires),
            'scope'              => $scope,
        ));
        $authCode->save();

    }

    public function expireAuthorizationCode($code)
    {

        $authCode = new Oauth2ServerPhpAuthCode($code);
        if ($authCode->isLoaded()) {
            $authCode->delete();
        }
    }
}
