<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class TestBean extends AbstractBean {
    public function __construct() {
        $this->properties = array(
            'id' => 0,
            'test' => ''
        );
    }
}
?>
