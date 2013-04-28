<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultTableBean extends TableBean {
    public function __construct(&$properties = '') {
        $this->properties = array(
            'foo' => 0,
            'boo' => ''
        );
    }
}
?>
