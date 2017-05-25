<?php

function g($get_name){
    $gets = $_GET[$get_name]??null;
    if( $gets !=null ){
        return htmlspecialchars($_GET[$get_name]);
    }else{
        return null;
    }
}
