<?php

// key=[action]
return array(
    "authorize"=>array('always_access'=>true),
    "token"=>array('mode'=>'json','always_access'=>true),
    "refresh"=>array('mode'=>'json','always_access'=>true),
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true,
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),

);