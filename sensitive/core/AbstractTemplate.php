<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractTemplate extends AbstractBase {
    protected $config = array();
    protected $vars = array();
    protected $headers = array();
    protected $metas = array();
    protected $jses = array();
    protected $javascript = array();
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
    //set title ,if $append equal false, then reset title;if $append equal 1 or true,then append end position; other append start position
    public function title($str, $append = false) {
        $vars  = &$this->vars;
		$title = isset($vars['title'])?$vars['title']:false;
		if(!$title || $append === false) {
			$vars['title'] = $str;
		} else if($append && $append === 1) {
			$vars['title'] = $title.$str;
		} else {
			$vars['title'] = $str.$title;
		}
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
    //set meta infomation
    public function meta($meta) {
        $metas = &$this->metas;
        if(is_array($meta)) {
            foreach($meta as $i=>$m) {
                $metas[] = $m;
            }
        } else {
            $metas[] = $meta;
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
    //set include js path
    public function javascript($js) {
        $javascript   = &$this->javascript;
        if(is_array($js)) {
            foreach($js as $i=>$j) {
                $javascript[] = $j;
            }
        } else {
            $javascript[] = $js;
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
        $metas        = &$this->metas;
        $jses         = &$this->jses;
        $javascript   = &$this->javascript;
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
