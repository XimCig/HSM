<?php

/*
 *  打印
 * */
function dump($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function error404(){
    include __PATH.'/hsm/page/404.php';

}

/*
 *      url生成
 */
function url($string,$param=false){


    $url_p = (explode('/',$string));
    if(config('route') && $param==false){
        return __APP .$string.config('route_file_type');
    }else {
        return __APP . config('run_script') . '?' . config('url_param_controller') . '=' . $url_p['0'] . '&' . config('url_param_action') . '=' . $url_p[1];
    }

}

/*
 *      读取配置
 */
function config($name,$value=false){
    return hsm\HSM_::config($name,$value);
}