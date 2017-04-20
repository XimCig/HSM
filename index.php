<?php
/**
 *      HSM-PHP   小型PHP-MVC框架
 *      作者:     Cuixg
 *      邮箱：    252560815@qq.com
 */




/**
 *  DEBUG
 */


define("DEBUG",true);
if(!DEBUG){
    ini_set("display_errors",'on');
}
$hsm_config['hsm']  =   "./hsm/";    // HSM Framework Path

require_once( $hsm_config['hsm']."hsm.class.php" );

hsm\HSM_::main();