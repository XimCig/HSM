<?php

class Index extends Controller{


    public function indexAction(){
      dump($_GET);
        $a = db();
        $id = g('id')??20;
        echo $id;
        dump( $a->prep("select * from positive where id=:id",['id'=>$id])->resultOne() );
    }

    public function FucksAction(){
      echo "1";
    }
}
