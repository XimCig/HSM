<?php

class Index extends Controller{
    public function indexAction(){
       $a = db();


       dump( $a->query('select * from posistive where id=202')->resultOne() );


       // echo mysql_db::$conn_num;
       // $this->view();
    }

    public function fuAction(){
        $this->view();
    }

    public function fuxAction(){
        $this->json(array('a'=>'1'));
    }
}