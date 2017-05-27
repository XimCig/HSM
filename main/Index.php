<?php

class Index extends Controller{

    /**
     * [indexAction description]
     * @return [type] [description]
     */
    public function indexAction(){
      db();
    }

    public function FucksAction(){

var_dump($_SERVER['HTTP_REFERER']);
    }

    public function ssAction(){
      $this->view();
    }
}
