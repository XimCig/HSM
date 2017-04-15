<?php
namespace hsm;
/**
 *  hsm\HSM_  :: main()
 */
class HSM_
{
    static private $config;        //config

    static public function main(){

        $hsm_config_path = $GLOBALS['hsm_config']['hsm'];

        require_once( $hsm_config_path.'configure.php');

        self::$config = $config;

        self::$config['hsm'] =  $hsm_config_path;

        self::assembly();
    }

    /*
     *      Assembly Line
     */
    static private function assembly()
    {
        self::loader();
        self::route();
    }

   static private function route()
   {
        require_once(self::$config['hsm'].DS.'library'.DS."route.php");
        $RouteHSM = new RouteHSM( self::$config['route'] );
    }

    static private function loader()
    {
        require_once(self::$config['hsm'].DS.'helper'.DS.'input.php');
    }
}