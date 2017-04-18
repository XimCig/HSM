<?php

class Index extends Controller{
    public function indexAction(){
        $a = new test();
        $a->run();
       // $this->view();
    }

    public function fuAction(){
        $this->view();
    }
}