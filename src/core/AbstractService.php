<?php
abstract class AbstractService extends AbstractBase {
    protected $config = array();
    public function setConfig($config) {
        $this->config = $config;
    }
    public function init() {
        echo 'AbstractService init';
        $config     = &$this->config;
        $storeGen   = new DefaultStoreGen();
        $store      = $storeGen->genStore();
        $initBoo    = $store->init();
    }
}
?>
