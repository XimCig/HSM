<?php

function g($get_name){
    if( isset($_GET[$get_name]) && $_GET[$get_name]!=null ){
        return htmlspecialchars($_GET[$get_name]);
    }else{
        return false;
    }
}