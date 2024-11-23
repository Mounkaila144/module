<?php
require_once dirname(__FILE__)."/../locales/Forms/ServicesZapierClientForm.class.php";
class services_zapier_ajaxNewClientAction extends mfAction
{
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->item = new ServicesZapierClient();
        $this->form = new ServicesZapierClientForm($request->getPostParameter('Client'));
        if ($request->getPostParameter('Client')) {
            try {
                $this->form->bind($request->getPostParameter('Client'));
                if ($this->form->isValid()) {
                    $clientId = bin2hex(openssl_random_pseudo_bytes(16));
                    $clientSecret = bin2hex(openssl_random_pseudo_bytes(32));

                    $redirectUri = $this->form->getValue('redirect_uri');
                    $name = $this->form->getValue('name'); // Si vous voulez un nom pour le client

                    $this->item->add([
                        'client_id' => $clientId,
                        'client_secret' => $clientSecret,
                        'grant_types' => 'authorization_code refresh_token',
                        'redirect_uri' => $redirectUri,
                        'name' => $name // Ou une autre méthode pour définir le nom du client.
                    ]);
                    $this->item->save();
                    $messages->addInfo(__("Client has been created."));
                    $this->forward('services_zapier', 'ajaxListPartialClient');
                } else {
                    $messages->addError(__("Form has some errors"));
                    $this->item->add($request->getPostParameter('Client'));
                   echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo '</pre>';

                }
            } catch (mfException $e) {
                $messages->addError($e);
            }
        }
    }
}






