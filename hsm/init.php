<?php
if(DEBUG){
    error_reporting(E_ALL);
    ini_set("display_errors",'on');
    header("cache-control:no-cache,must-revalidate");
  
}else{
    error_reporting(0);
    ini_set("display_errors",'off');
}

require_once( $hsm_config['hsm']."hsm.class.php" );

hsm\HSM_::main();
