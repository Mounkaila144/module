<?php

// key=[action]
return array(
    "resource"=>array('mode'=>'json','always_access'=>true),
    "lead"=>array('mode'=>'json','always_access'=>true),

    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true,
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),

);