<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractStore extends AbstractBase {
    protected $config;
    public function __construct($config = '') {
        $this->config = $config;
    }
    public function init() {
        //echo 'AbstractStore init';
        return $this;
    }
}
?>
