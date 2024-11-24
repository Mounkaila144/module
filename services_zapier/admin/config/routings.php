<?php

return array(

    "services_zapier_ajax" => array("pattern" => '/module/service/zapier/admin/{action}', "module" => "services_zapier", "action" => "ajax{action}", "requirements" => array("action" => ".*")),

    //"services_zapier"=>array("pattern"=>'/{action}',"module"=>"services_zapier","action"=>"{action}","requirements"=>array("action"=>".*")),

    "services_zapier_authorize" => array("pattern" => '/authorize',
        "module" => "services_zapier",
        "action" => "authorize",
    ),
    "services_zapier_token" => array("pattern" => '/token',
        "module" => "services_zapier",
        "action" => "token",
    ),
    "services_zapier_resource" => array("pattern" => '/test',
        "module" => "services_zapier",
        "action" => "resource",
    ),
 "services_zapier_addLead" => array("pattern" => '/add',
        "module" => "services_zapier",
        "action" => "addLead",
    ),

 "services_zapier_refreshToken" => array("pattern" => '/refresh/token',
        "module" => "services_zapier",
        "action" => "refreshToken",
    ),

);

