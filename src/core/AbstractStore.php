<?php
abstract class AbstractStore extends AbstractBase {
    protected $config;
    public function setConfig($config) {
        $this->config = $config;
    }
    public function init() {
        echo 'AbstractStore init';
    }
}
?>
