<?php

class Index extends Controller{


    public function indexAction(){

        $a = db();

      dump( $a->prep("select * from positive where id=:id",['id'=>g('id')])->resultOne() );
    }

    public function FucksAction(){
      echo "1";
    }
}
