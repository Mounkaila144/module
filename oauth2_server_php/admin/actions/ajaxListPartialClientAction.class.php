<?php

require_once dirname(__FILE__)."/../locales/FormFilters/Oauth2ServerPhpClientFormFilter.class.php";
require_once dirname(__FILE__) . "/../locales/Pagers/Oauth2ServerPhpClientPager.class.php";

class oauth2_server_php_ajaxListPartialClientAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->formFilter= new Oauth2ServerPhpClientFormFilter();
        $this->pager=new Oauth2ServerPhpClientPager();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}

