<?php
/**
 *      HSM-PHP   小型PHP-MVC框架
 *      作者:     Cuixg
 *      邮箱：    252560815@qq.com
 */




/**
 *  DEBUG
 */


define("DEBUG",false);

$hsm_config['hsm']  =   "./hsm/";    // HSM Framework Path

if(DEBUG){
    require_once ($hsm_config['hsm'].'library/php_error.php');

    \php_error\reportErrors();
}else{
    ini_set("display_errors","on");     // DEBUG -  On | Off
}




require_once( $hsm_config['hsm']."hsm.class.php" );

hsm\HSM_::main();