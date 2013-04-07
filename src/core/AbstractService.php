<?php
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
        $store      = $storeGen->genStore()->init();
		return $this;
    }
}
?>
