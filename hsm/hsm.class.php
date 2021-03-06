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
        //记录应用开始时间
        self::$start_time = microtime(true);

    }


    //主程序   - main
    static public function main(){


        self::__start();

        $hsm_config_path = $GLOBALS['hsm_config']['hsm'];

        require_once( $hsm_config_path.'configure.php');

        self::$config = $config;

        self::$config['hsm'] =  $hsm_config_path;

        //装配应用
        self::assembly();

        self::__end();
    }

    /*
     *      Assembly Line
     */
    static private function assembly()
    {
        //载入library文件
        self::loader();
        //定义常用变量
        self::definition();
        //运行路由
        self::route();

    }

   static private function route()
   {

        //路由匹配类
        require_once ( self::$config['hsm'].DS.'library'.DS.'registerRoute.php');


        //路由配置文件
        require_once ( self::$config['controller_path'].DS.'route.php');

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
          $method = $userReturn['action'];
            $app_main->$method();
        }else{
            echo "Not found method ".$userReturn['action']." in Class ".$userReturn['controller']."!";
        }




   }

    static private function loader()
    {
        /*if(DEBUG){
            require_once (self::$config['hsm'].'library'.DS.'HSMerror.php');
        }*/
       $loader['system'] = require_once (self::$config['hsm'].DS.'config'.DS.'loader.php');



       foreach ( $loader['system'] as $v ){
           require_once ( self::$config['hsm'].$v.'.php');
       }



       require_once ( self::$config['hsm'].DS.'library'.DS.'registerRoute.php');

       require_once ( self::$config['controller_path'].DS.'route.php');



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

    static private function definition(){

        if( $_SERVER['REQUEST_METHOD'] == "POST"){
            define('IS_POST',true);
        }else{
            define("IS_POST",false);
        }



    }



        //程序结束
        static function __end()
        {
            //记录结束时间
            self::$end_time = microtime(true);

            //输出运行时间
            if(DEBUG && !self::config('pageIsJson') ){

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
                   Run : '.((round(self::$end_time - self::$start_time,5))*1000).'Mili
                    </div>
                    ';
            }
        }
}
