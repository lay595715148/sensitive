<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractTemplate extends AbstractBase {
    protected $config = array();
    protected $vars = array();
    protected $file;
    public function __construct($config = '') {
        $this->config = $config;
	}
    public function init() {//must return $this
        return $this;
    }
    public function push($key, $value) {
        $vars = &$this->vars;
        $vars[$key] = $value;
    }
    public function file($filename) {
        $this->file = $filename;
    }
    public function json() {
        $templateVars = &$this->vars;
        echo json_encode($templateVars);
    }
    public function out() {
        $templateVars = &$this->vars;
        $templateFile = &$this->file;
        extract($vars);
        include($file);
    }
}
?>
