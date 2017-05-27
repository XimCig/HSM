<?php

function g($get_name){
    $gets = $_GET[$get_name]??null;
    if( $gets !=null ){
        return htmlspecialchars($_GET[$get_name]);
    }else{
        return null;
    }
}


function p($post_name){
  $posts = $_POST[$post_name]??null;
  if( $posts !=null ){
      return htmlspecialchars($_POST[$post_name]);
  }else{
      return null;
  }

}
