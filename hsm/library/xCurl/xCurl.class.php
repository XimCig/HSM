<?php
class xCurl{
      public $crUrl;

      public $curlHandle;    //需要爬取的URL

      public $errorInfo;

      // 默认设置
      public function retOption(){
          return array(
            CURLOPT_URL              => $this->crUrl,     //目标URL
            CURLOPT_RETURNTRANSFER   => 1, //存为字符串，不是直接输出
            CURLOPT_HEADER           => 0, //关闭HTTP头在信息流中输出
            CURLOPT_REFERER          => 'https://www.baidu.com/?from=1001703y',
          );
      }


      /**
       * [UA 用户设备]
       * @param [type] $typeName [设备名称]
       */
      public function UA( $typeName ){
          $UA_data = array(
            'firefox' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',
            'chrome'  => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
            'android' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Mobile Safari/537.36',
            'iphone'  => 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'
          );
          return $UA_data[$typeName];
      }


      /**
       * [__construct description]
       * @param [type] $crUrl [description]
       * @param string $ua    [description]
       *   self::__construct ( "http://qq.com", 'android');
       */
      public function __construct( $crUrl , $ua="iphone"){

          if( !function_exists('curl_init') ){
              die("Error! Curl function not find! The program will quit!");
          }

          $this->curlHandle = curl_init();      //curl 初始化

          $this->crUrl = $crUrl;


          curl_setopt_array( $this->curlHandle , $this->retOption());

          curl_setopt( $this->curlHandle , CURLOPT_USERAGENT ,$this->UA( $ua ) );
      }

      //设置CURL
      public function config( $config=array() ){


        curl_setopt_array( $this->curlHandle, $config);

        return $this;
      }

      /**
       * [getPage 获取页面内容]
       * @return [type] [description]
       */
      public function getPage(){

        $result = curl_exec($this->curlHandle);
        if( curl_errno( $this->curlHandle ) ){

          $this->error = 'curl Error : '. curl_error( $this->curlHandle);

          return false;
        }else{
          return $result;
        }
      }


      /**
       * [getinfo 返回此次请求信息]
       * @return [type] [description]
       */
      public function getinfo(){
        return curl_getinfo($this->curlHandle);
      }
      public function __destruct(){
          curl_close( $this->curlHandle );
      }
}
