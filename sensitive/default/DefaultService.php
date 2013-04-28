<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultService extends AbstractService {
    public function defaultFunction() {
        return array('mysql','mysqli');
    }
}
?>
