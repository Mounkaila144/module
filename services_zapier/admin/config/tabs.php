<?php

return array(
    
    "dashboard.site"=>array(

        "dashboard-x-list-client" => array(
            "title" => "Auth2.0 Client",
            "route"=>array("services_zapier_ajax"=>array("action"=>"ListPartialClient")),
            'functions'=>array('html_options_client'=>null),
            "credentials"=>array(array('superadmin','services_zapier_lient')),
        ),
    
   
 ),
  
);