<?php


class Oauth2ServerPhpClientPager extends Pager
{

    function __construct()
    {
        parent::__construct(array("Oauth2ServerPhpClient"));
    }
    protected function fetchObjects($db)
    {
        while ($items = $db->fetchObjects()) {
            $item = $items->getOauth2ServerPhpClient();
            $this->items[$item->get('client_id')] = $item;
        }
    }
}