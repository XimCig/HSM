<?php
namespace hsm;
class reg{
    static private $result=array('get'=>array(),'any'=>array(),'post'=>array()); //存储路由结果
    static private $pi;             // PATH_INFO


    /**
     * [any 录入路由规则]
     * @param  [type] $url_preg [URL正则]
     * @param  [type] $action   [目标控制器]
     * @return [null]
     * self::any("/(.*)+","Index/index");
     */
    static function any($url_preg,$action){

        $result_count = count(@self::$result['any']);
        self::$result['any'][$result_count][] = $url_preg;
        self::$result['any'][$result_count][] = $action;
    }



    /**
     * [main 路由开始入口]
     * @param  [type] $path_info [URI]
     * @return [type]            [description]
     */
    static function main($path_info){
        //默认匹配规则
        self::any("/([a-zA-Z0-9]+)/([a-zA-Z0-9]+)(.*)","$1/$2");

        self::$pi =  $path_info;

    }

    /**
     * [returnRoute 获取路由结果]
     * @return [type] [description]
     */
    static function returnRoute()
    {

        $userReturn = self::matchingAny();
        return ($userReturn);

    }

    /**
     * [matchingAny 匹配路由]
     * @return [String]   [匹配返回的路由结果]
     */
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
