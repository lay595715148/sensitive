<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractAction extends AbstractBase {
    protected $config = array();
    protected $services = array();
    protected $beans = array();
    protected $template;
    protected $pathinfo = array();
    public function __construct($config = '') {
        $this->config = $config;
    }
    public function init() {//must return $this
        $this->pathinfo = pathinfo($_SERVER['PHP_SELF']);
        
        $config      = &$this->config;
        $services    = &$this->services;
        $beans       = &$this->beans;
        $template    = &$this->template;
        $serviceGen  = new DefaultServiceGen();
        $beanGen     = new DefaultBeanGen();
        $templateGen = new DefaultTemplateGen();

        if(is_array($config) && array_key_exists('services',$config) && $config['services'] && is_array($config['services'])) {
            //加载配置中的所有service
            foreach($config['services'] as $k=>$v) {
                $service = $serviceGen->genService($v)->init();
                $services[$v] = $service;
            }
        } else {
            $service = $serviceGen->genService()->init();
            $services[] = $service;
        }
        if(is_array($config) && array_key_exists('beans',$config) && $config['beans'] && is_array($config['beans'])) {
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
    }
    public function dispatch($e = null) {//must return $this
        global $_CFG;

        $dispatchkey = $_CFG['action']['dispatch-key'];
        $style       = $_CFG['action']['dispatch-style'];
        $method      = $_CFG['action']['dispatch-method'];
        $scope       = $_CFG['action']['dispatch-scope'];

        if($dispatchkey) {
            $variable   = Scope::parseScope((is_numeric($scope) && $scope >= 0 && $scope <= 5)?$scope:0);
            $dispatcher = (array_key_exists($dispatchkey,$variable))?$_REQUEST[$dispatchkey]:false;
        } else {
            $ext        = pathinfo($_SERVER['PHP_SELF']);
            $dispatcher = $ext['filename'];
        }
        if($dispatcher) {
            $method = str_replace('*',$dispatcher,$style);
        }

        if(method_exists($this,$method) && $method != 'init' && $method != 'tail' && $method != 'dispatch' && substr($method,0,2) != '__') {
            $this->$method();
        } else if($e){
            $this->launch($e);
        } else {
            $this->launch();
		}
        
        return $this;
    }
    public function tail() {//must return $this
        $ext = &$this->pathinfo;
        $extension = array_key_exists('extension',$ext)?$ext['extension']:'';
        switch($extension) {
            case 'json':
                $this->template->header('Content-Type: application/json');
                $this->template->header('Cache-Control: no-store');
                $this->template->json();
                break;
            case 'xml':
                $this->template->header('Content-Type: text/xml');
                $this->template->xml();
                break;
            default:
                $this->template->out();
        }
        return $this;
    }
}
?>
