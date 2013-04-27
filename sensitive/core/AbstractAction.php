<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractAction extends AbstractBase {
    protected $config = array();
    protected $services = array();
    protected $beans = array();
    protected $template;
    public function __construct($config = '') {
        $this->config = $config;
	}
    public function init() {//must return $this
        //echo 'AbstractAction init';
        $config      = &$this->config;
        $services    = &$this->services;
        $beans       = &$this->beans;
        $template    = &$this->template;
        $serviceGen  = new DefaultServiceGen();
        $beanGen     = new DefaultBeanGen();
        $templateGen = new DefaultTemplateGen();

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
            //加载配置中的所有bean
            foreach($config['beans'] as $k=>$v) {
                $bean = $beanGen->genBean($v);
                $beans[$v] = $bean;
            }
        } else {
            $bean = $beanGen->genBean();
            $beans[] = $bean;
        }
        $template = $templateGen->genTemplate()->init();

        return $this;
    }
    public function launch() {
        //echo 'AbstractAction launch';
    }
    public function dispatch() {//must return $this
        //echo 'AbstractAction dispatch';
        global $_CFG;
        $key        = $_CFG['action']['dispatch-key'];
        $style      = $_CFG['action']['dispatch-style'];
        $method     = $_CFG['action']['dispatch-method'];
        $scope      = $_CFG['action']['dispatch-scope'];
        $variable   = Scope::parseScope((is_numeric($scope) && $scope >= 0 && $scope <= 5)?$scope:0);

        $dispatcher = (array_key_exists($key,$variable))?$_REQUEST[$key]:false;
        if($dispatch) {
            $method = str_replace('*',$dispatcher,$style);
        } else {
            $this->$method();
        }
        
        return $this;
    }
    public function tail() {//must return $this
        return $this;
    }
}
?>
