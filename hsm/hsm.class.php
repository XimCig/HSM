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

        if(DEBUG && self::config('pageIsJson') ){

            echo '<div style="position: fixed;
    line-height:25px;
    border-radius:5px;
    text-align: center;
    right: 10px;
    bottom: 10px;
    width: 135px;
    height: 25px;
    background: rgba(9, 168, 0, 0.75);
    color: rgb(255, 255, 255);">
               Run : '.round (self::$end_time - self::$start_time,4).'S
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

        if( method_exists($app_main,$userReturn['action']) ){
            $app_main->$userReturn['action']();
        }else{
            $method = self::$config['default_controller'].self::$config['action_name'];
            
            $app_main->$method();
        }


   }

    static private function loader()
    {
        if(DEBUG){
            require_once (self::$config['hsm'].'library'.DS.'HSMerror.php');
        }
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
            return isset( self::$config[$configName] )?  self::$config[$configName] :false;
        }


    }


    static public function print_error($e){

        if(DEBUG) {

            require_once(self::config('hsm') . DS . 'page' . DS . 'error.php');
            self::__end();
        }else{
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            error404();
        }
        die();
    }
}