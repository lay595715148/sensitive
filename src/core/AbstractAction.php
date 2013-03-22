<?php
abstract class AbstractAction extends AbstractBase {
    protected $config = array();
    protected $services = array();
    protected $beans = array();
    public function setConfig($config) {
        $this->config = $config;
    }
    public function init() {
        echo 'AbstractAction init';
        $config     = &$this->config;
        $serviceGen = new DefaultServiceGen();

        if($config['services'] && is_array($config['services'])) {
            //加载配置中的所有service
            foreach($config['services'] as $k=>$v) {
                $service = $serviceGen->genService($v);
                $initBoo = $service->init();
            }
        } else {
            $service = $serviceGen->genService();
            $initBoo = $service->init();
        }
    }
    public function launch() {
        echo 'AbstractAction launch';
    }
    public function dispatch() {
        echo 'AbstractAction dispatch';
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
    }
}
?>
