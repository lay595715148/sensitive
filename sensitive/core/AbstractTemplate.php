<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractTemplate extends AbstractBase {
    protected $config = array();
    protected $vars = array();
    protected $headers = array();
    protected $jses = array();
    protected $csses = array();
    protected $file;
    public function __construct($config = '') {
        $this->config = $config;
	}
    public function init() {//must return $this
        return $this;
    }
    //push header for output
    public function header($header) {
        $headers   = &$this->headers;
        $headers[] = $header;
    }
    //push variables with a name
    public function push($name, $value) {
        $vars        = &$this->vars;
        $vars[$name] = $value;
    }
    //set include template file path
    public function file($filepath) {
        $this->file = $filepath;
    }
    //set include js path
    public function js($js) {
        $jses   = &$this->jses;
        $jses[] = $js;
    }
    //set include css path
    public function css($css) {
        $csses   = &$this->csses;
        $csses[] = $css;
    }
    //output json
    public function json() {
        $templateVars = &$this->vars;
        echo json_encode($templateVars);
    }
    //output template
    public function out() {
        global $_SRCPath;
        $templateVars = &$this->vars;
        $templateFile = &$this->file;
        $jses         = &$this->jses;
        $csses        = &$this->csses;
        $headers      = &$this->headers;

        extract($templateVars);
        foreach($headers as $header) {
            header($header);
        }
        if(file_exists($templateFile)) {
            include($templateFile);
        }
    }
}
?>
