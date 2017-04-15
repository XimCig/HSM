<?php

function g($get_name){
    if( isset($get_name) && $get_name!=null ){
        return htmlspecialchars($get_name);
    }else{
        return false;
    }
}