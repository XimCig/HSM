<?php

define("__PATH",dirname( $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'] ) );        //程序根目录

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

    'route'                   =>    true,                          //如果不开启路由，则使用参数url




    /* ===路径设置=== */
    'controller_path'        =>   __PATH.DS."main".DS,         //控制器路径

    'themplate_path'         =>   __PATH.DS."theme".DS,         //视图路径

    'model_path'              =>   __PATH.DS."model".DS,        //模型路径

);