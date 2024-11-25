<?php

return array(

    "items" => array(
        "site_services"=>array(
            "childs"=>array("oauth2_server_php_setting"=>null
            ),
        ),

        "oauth2_server_php_setting" => array(
            "title" =>"Setting Auth2.0 Zapier",
            //"picture"=>"/pictures/icons/sheets.png",
            "route_ajax"=>array("oauth2_server_php_ajax"=>array("action"=>"Settings")),
            "credentials"=>array(array('superadmin','admin','oauth2_server_php_setting')),
        ),



    )

);
