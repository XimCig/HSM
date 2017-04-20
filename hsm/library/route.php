<?php
namespace hsm;

class RouteHSM{


    private $main_param = 'main';

    private $main_name     = "Index";

    private $action_param = 'action';

    private $action_name    =   'index';


    private $action_name_after = "Action";

    public $userReturn;
    public function __construct($routeOpen)
    {
        header('X-Powered-By:HSM-0.1');



        if(  config('route')==true) {

        $path_info = isset( $_SERVER['PATH_INFO'] )?$_SERVER['PATH_INFO']:"/";
        $path_info = str_replace( dirname($_SERVER['REQUEST_URI']),'',$_SERVER['REQUEST_URI']);
        reg::main( $path_info );
            $routeResult = reg::returnRoute();
        if( $routeResult ){
             $this->HandleRoute($routeResult);
        }else{
            $routeParam = $this->Urlparam();

        }

        }else{
            $routeParam = $this->Urlparam();

        }

    }

    private function Urlparam()
    {

        if( g($this->main_param) ){
            $User_request['controller'] = g($this->main_param);
        }else{
            $User_request['controller'] = $this->main_name;
        }

        if( g( $this->action_param )){
            $User_request['run_action'] = g($this->action_param);
            $User_request['action'] = g($this->action_param).$this->action_name_after;
        }else{
            $User_request['run_action'] = $this->action_name;
            $User_request['action'] = $this->action_name.$this->action_name_after;
        }
        $this->userReturn   =  $User_request;
    }

    public function HandleRoute($routeResult){

        $re_arr = explode("/",$routeResult);


        $User_request['controller'] = $re_arr[0];

        $User_request['run_action'] = $re_arr[1];

        $User_request['action'] = $re_arr[1].$this->action_name_after;

        $this->userReturn   =  $User_request;
    }
}