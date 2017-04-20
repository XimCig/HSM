<?php

define("__PATH",dirname(dirname(__FILE__)) );        //程序根目录


define("DS","/");

/*  web目录 */
$app_path_ = dirname($_SERVER['SCRIPT_NAME']);
    if($app_path_ == "\\" || $app_path_=="" )
    {
        define("__APP","/");
    }else{
        define("__APP",$app_path_.'/');
    }



$config = array(
    /* ===配置项 === */

    'route'                   =>    true,                          //开启路由，将会自检 main/route.php 文件
    'route_file_type'       =>     ".html",                     //开启路由后，自动匹配的文件类型

    'run_script'             =>     'index.php',

    'default_controller'    =>    'Index',  //默认控制器
    'default_action'    =>     'index', //默认方法

    'url_param_controller'  =>      'main', //url中控制器的参数
    'url_param_action'       =>      'action', //url中操作的参数

    'action_name'             =>     "Action",//操作名



    /* ===路径设置=== */
    'controller_path'        =>   __PATH.DS."main".DS,         //控制器路径

    'themplate_path'         =>   __PATH.DS."template".DS,         //视图路径

    'model_path'              =>   __PATH.DS."model".DS,        //模型路径

    'HSM_VERSION'            => '0.1'

);