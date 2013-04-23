<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractService extends AbstractBase {
    protected $config;
    protected $store;
    public function __construct($config = '') {
        $this->config = $config;
	}
    public function init() {
        //echo 'AbstractService init';
        $config     = &$this->config;
        $store      = &$this->store;
        $storeGen   = new DefaultStoreGen();

        if($config['store'] && is_string($config['store'])) {
            //加载配置中的store
            $store = $storeGen->genStore($config['store'])->init();
        } else {
            $store = $storeGen->genStore()->init();
        }
		return $this;
    }
}
?>
