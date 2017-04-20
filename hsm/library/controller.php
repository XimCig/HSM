<?php
class Controller{

    public $run;

    public $view_FileType = '.html';
    public function __construct()
    {

    }

    public function view($viewFile=false)
    {
        header('Content-Type:text/html');

        $run = config('run');

        $viewFile = $viewFile?$viewFile:$run['run_action'];

       // $html =  file_get_contents( config('themplate_path').$run['controller'].DS.$viewFile.$this->view_FileType  ) ;
        require_once (  config('themplate_path').$run['controller'].DS.$viewFile.$this->view_FileType  );
    }

    public function json($jsArr)
    {
        header('Content-type:application/json');
        echo json_encode($jsArr);
        config("pageIsJson",true);
    }

    public function js($jsStr){
        header("Content-Type:application/javascript");
        echo $jsStr;
        config("pageIsJson",true);
    }
}