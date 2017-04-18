<?php
namespace hsm;


/**
 *  hsm\HSM_  :: main()
 */
class HSM_
{
    static private $config;        //config

    static $start_time;             //程序开始时间

    static $end_time;               //程序结束时间

    //程序开始
    static function __start()
    {
        self::$start_time = microtime(true);

    }

    //程序结束
    static function __end()
    {
        self::$end_time = microtime(true);

        if(!DEBUG){

            echo '<div style="position: fixed;
    line-height:25px;
    text-align: center;
    right: 0;
    bottom: 0;
    width: 135px;
    height: 25px;
    background: rgba(9, 168, 0, 0.75);
    color: rgb(255, 255, 255);">
               Run : '.round (self::$end_time - self::$start_time,5).'S
                </div>
                ';
        }
    }

    //主程序   - main
    static public function main(){
        self::__start();

        $hsm_config_path = $GLOBALS['hsm_config']['hsm'];

        require_once( $hsm_config_path.'configure.php');

        self::$config = $config;

        self::$config['hsm'] =  $hsm_config_path;

        self::assembly();

        self::__end();
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
       //运行路由
        require_once(self::$config['hsm'].DS.'library'.DS."route.php");

        $RouteHSM = new RouteHSM( self::$config['route'] );

        $userReturn = ($RouteHSM->userReturn);

        self::$config['run'] = $userReturn;

        $actionFile = self::$config['controller_path'].$userReturn['controller'].'.php';

       if(!file_exists( $actionFile )  && DEBUG==false )error404();

        require_once ($actionFile);
        //运行实例
        $app_main  = new $userReturn['controller']();
        $app_main->$userReturn['action']();

   }

    static private function loader()
    {
       $loader['system'] = require_once (self::$config['hsm'].DS.'config'.DS.'loader.php');


       foreach ( $loader['system'] as $v ){
           require_once ( self::$config['hsm'].$v.'.php');
       }

        if(self::config('route')) {

            require_once ( self::$config['hsm'].DS.'library'.DS.'registerRoute.php');

            require_once ( self::$config['controller_path'].DS.'route.php');

        }

    }

    static public function config($configName,$configValue=false){

        if($configValue){
           self::$config[$configName] = $configValue;
           return true;
        }else{
            return self::$config[$configName];
        }


    }
}