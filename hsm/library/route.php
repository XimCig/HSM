<?php
namespace hsm;

class RouteHSM{


    private $default_main = 'main';

    private $main_name     = "Index";

    private $default_action = 'action';

    private $action_name    =   'index';

    private $action_name_after = "Action";


    public function __construct($routeOpen)
    {
        header('X-Powered-By:HSM-0.1');
        if( $routeOpen ){

        }else{
            //param
            $this->Urlparam();
        }
    }

    private function Urlparam()
    {

    }

}