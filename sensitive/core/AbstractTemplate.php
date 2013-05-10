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
        global $_CFG,$_SRCPath;
        $lang = &$_CFG['language'];
        $langs = &$_CFG['languages'];
        if($lang && array_key_exists($lang,$langs) && file_exists($_SRCPath.$langs[$lang])) {
            include $_SRCPath.$langs[$lang];
        }
        
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
    //set include file path
    public function file($filepath) {
        $this->file = $filepath;
    }
    //set include theme template file path
    public function template($filepath) {
        global $_CFG,$_SRCPath;
        $theme = &$_CFG['theme']['theme-use'];
        $themes = &$_CFG['themes'];
        if(array_key_exists($theme,$themes)) {
            $this->file = $_SRCPath.$_CFG['theme']['theme-dir'].$themes[$theme]['tpl'].$filepath;
        } else {
            $this->file = $filepath;
        }
    }
    //set include js path
    public function js($js) {
        $jses   = &$this->jses;
        if(is_array($js)) {
            foreach($js as $i=>$j) {
                $jses[] = $j;
            }
        } else {
            $jses[] = $js;
        }
    }
    //set include css path
    public function css($css) {
        $csses   = &$this->csses;
        if(is_array($css)) {
            foreach($css as $i=>$c) {
                $csses[] = $c;
            }
        } else {
            $csses[] = $css;
        }
    }
    //output json
    public function json() {
        $headers      = &$this->headers;
        $templateVars = &$this->vars;
        foreach($headers as $header) {
            header($header);
        }
        echo json_encode($templateVars);
    }
    //output xml
    public function xml() {
        $headers      = &$this->headers;
        $templateVars = &$this->vars;
        foreach($headers as $header) {
            header($header);
        }
        echo Parser::array2XML($templateVars);
    }
    //output template
    public function out() {
        global $_SRCPath,$_CFG,$_LAN;
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
