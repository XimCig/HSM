<?php
namespace hsm;
class reg{
    static private $result=array('get'=>array(),'any'=>array(),'post'=>array()); //存储路由结果
    static private $pi;             // PATH_INFO

    static function get($url_preg,$action){

        $result_count = count(@self::$result['get']);
        self::$result['get'][$result_count][] = $url_preg;
        self::$result['get'][$result_count][] = $action;
    }

    static function any($url_preg,$action){

        $result_count = count(@self::$result['any']);
        self::$result['any'][$result_count][] = $url_preg;
        self::$result['any'][$result_count][] = $action;
    }




    static function main($path_info){
        self::any("/(.*)/(.*)","$1/$2");
        self::$pi =  $path_info;

    }

    static function returnRoute()
    {


        $userReturn = self::matchingAny();

      


        return ($userReturn);
    }
    static private function matchingGet(){
        $getPreg = self::$result['get'];
        $pi = self::$pi;
        $result = false;
        foreach( $getPreg as $k=>$v ){
            // echo "#^".$v[0]."$#";
            if( preg_match_all("#^".$v[0]."$#",$pi,$matches) ){
                $result = $v[1];
                break;
            }
        }


        @$matches = count($matches[0])>0?$matches:false;

        if( strpos($result,'$')!==false){
            unset($matches[0]);
            foreach ($matches as $k=>$v){

                $result = preg_replace('/\$'.$k.'/',$v[0],$result);
            }


        }
        return $result;
    }

    static private function matchingPost(){

    }

    static private function matchingAny(){
      $getPreg = self::$result['any'];
       $pi = self::$pi;
      $result = false;

      foreach( $getPreg as $k=>$v ){
          // echo "#^".$v[0]."$#";
          if( preg_match_all("#^".$v[0]."$#",$pi,$matches) ){
              $result = $v[1];
              break;
          }
      }


      @$matches = count($matches[0])>0?$matches:false;

      if( strpos($result,'$')!==false){
          unset($matches[0]);
          foreach ($matches as $k=>$v){

              $result = preg_replace('/\$'.$k.'/',$v[0],$result);
          }


      }
      return $result;
    }
}
