<?php
require_once dirname(__FILE__)."/../locales/Forms/Oauth2ServerPhpClientViewForm.class.php";

class oauth2_server_php_ajaxViewClientAction extends mfAction {
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->client=new Oauth2ServerPhpClient($request->getPostParameter('Oauth2ServerPhpClient'));
        if ($this->client->isNotLoaded())
        {
            $messages->addError(__('Client is invalid'));
            $this->forward('oauth2_server_php','ajaxListPartialClient');
        }
        $this->form=new Oauth2ServerPhpClientViewForm();



    }

}
