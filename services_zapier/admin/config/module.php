<?php

// key=[action]
return array(

    "ajaxPingServerIcall26"=>array('mode'=>'json'),
    "authorize"=>array('always_access'=>true),
    "token"=>array('mode'=>'json','always_access'=>true),
    "refreshToken"=>array('mode'=>'json','always_access'=>true),
    "resource"=>array('mode'=>'json','always_access'=>true),
    "ajaxDeleteClient"=>array('mode'=>'json'),

    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true,
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),

);