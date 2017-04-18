<?php
class Controller{

    public $run;

    public $view_FileType = '.html';
    public function __construct()
    {

    }

    public function view()
    {
        header('Content-Type:text/html');
        $run = config('run');

        require_once ( config('themplate_path').$run['controller'].DS.$run['run_action'].$this->view_FileType ) ;
    }
}