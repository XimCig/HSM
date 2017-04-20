<?php
error_reporting(E_ALL & ~E_WARNING & ~E_ERROR);
set_error_handler('HSMerror',E_ERROR |E_WARNING);
set_exception_handler('HSMerror');

class HSMerror{
    public $ErrorType;

    public $Message;

    public $File;

    public $Line;

    public function getMessage(){
        return $this->Message;
    }
    public function getLine(){
        return $this->Line;
    }
    public function getErrorType(){
        return $this->ErrorType;
    }
    public function getFile(){
        return $this->File;
    }
    public function getTraceAsString(){
        return "";
    }

    public function printError(){
        $e = $this;
        require_once(config("hsm")."page".DS."error.php");
        hsm\HSM_::__end();
    }
}

function HSMerror($errno, $errstr, $errfile, $errline)
{


        $e = new HSMerror();
        $e->Message = $errstr;
        $e->Line = $errline;
        $e->File = $errfile;
        $e->ErrorType = $errno;

        $e->printError();

        die();

}

