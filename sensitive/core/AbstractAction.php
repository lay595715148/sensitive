<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractAction extends AbstractBase {
    protected $config = array();
    protected $services = array();
    protected $beans = array();
    public function __construct($config = '') {
        $this->config = $config;
	}
    public function init() {
        //echo 'AbstractAction init';
        $config     = &$this->config;
        $services   = &$this->services;
        $beans      = &$this->beans;
        $serviceGen = new DefaultServiceGen();
        $beanGen    = new DefaultBeanGen();

        if($config['services'] && is_array($config['services'])) {
            //加载配置中的所有service
            foreach($config['services'] as $k=>$v) {
                $service = $serviceGen->genService($v)->init();
                $services[$v] = $service;
            }
        } else {
            $service = $serviceGen->genService()->init();
            $services[] = $service;
        }
        if($config['beans'] && is_array($config['beans'])) {
            //加载配置中的所有service
            foreach($config['beans'] as $k=>$v) {
                $bean = $beanGen->genBean($v);
                $beans[$v] = $bean;
            }
        } else {
            $bean = $beanGen->genBean();
            $beans[] = $bean;
        }
        return $this;
    }
    public function launch() {
        //echo 'AbstractAction launch';
    }
    public function dispatch() {
        //echo 'AbstractAction dispatch';
        global $_CFG;
        $key        = $_CFG['action']['dispatch-key'];
        $style      = $_CFG['action']['dispatch-style'];
        $method     = $_CFG['action']['dispatch-method'];
        $variable   = $_REQUEST;

        $dispatch   = (array_key_exists($key,$variable))?$_REQUEST[$key]:false;
        if($dispatch) {
            $method = str_replace('*',$dispatch,$style);
        }
        $this->$method();
        
        return $this;
    }
}
?>
