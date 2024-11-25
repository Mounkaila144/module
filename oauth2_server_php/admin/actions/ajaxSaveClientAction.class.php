<?php
require_once dirname(__FILE__)."/../locales/Forms/Oauth2ServerPhpClientViewForm.class.php";

class oauth2_server_php_ajaxSaveClientAction extends mfAction {

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        try
        {
            $this->client=new Oauth2ServerPhpClient($request->getParameter('Client'));
            if ($this->client->isNotLoaded())
            {
                $messages->addError(__('Client is invalid'));
                $this->forward('oauth2_server_php','ajaxListPartialClient');
            }
            $this->form= new Oauth2ServerPhpClientViewForm($request->getPostParameter('Client'));
            $this->form->bind($request->getPostParameter('Client'));
            if ($this->form->isValid())
            {
                $this->client->set('name',$this->form->getValue('name'));
                $this->client->set('scope',$this->form->getValue('scope'));
                $this->client->set('redirect_uri',$this->form->getValue('redirect_uri'));
                $this->client->save();
                $messages->addInfo(__("Client has been updated."));
                $this->forward('oauth2_server_php','ajaxListPartialClient');
            }
            else
            {
                $messages->addError(__("Form has some errors"));
                echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo '</pre>';

            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
