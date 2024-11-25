<?php

return array(
    "oauth2_server_php_ajax" => array("pattern" => '/module/service/zapier/admin/{action}', "module" => "oauth2_server_php", "action" => "ajax{action}", "requirements" => array("action" => ".*")),

    "oauth2_server_php"=>array("pattern"=>'/{action}',"module"=>"oauth2_server_php","action"=>"{action}","requirements"=>array("action"=>".*")),


);

