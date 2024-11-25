<?php

return array(

    "services_zapier_ajax" => array("pattern" => '/service/zapier/{action}', "module" => "services_zapier", "action" => "ajax{action}", "requirements" => array("action" => ".*")),

    "services_zapier"=>array("pattern"=>'/service/zapier/{action}',"module"=>"services_zapier","action"=>"{action}","requirements"=>array("action"=>".*")),



);

