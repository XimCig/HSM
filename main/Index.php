<?php

class Index extends Controller{

    /**
     * [indexAction description]
     * @return [type] [description]
     */
    public function indexAction(){

      $xCurl = new xCurl( 'http://qder.coorain.com.cn','android');
      echo $xCurl
      ->config( [CURLOPT_HEADER=>0] )
      ->getPage();
      echo "1";
    }

    public function FucksAction(){

var_dump($_SERVER['HTTP_REFERER']);
    }

    public function ssAction(){
      $this->view();
    }
}
