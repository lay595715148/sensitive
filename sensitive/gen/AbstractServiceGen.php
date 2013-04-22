<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractServiceGen extends AbstractGen {
    public abstract function genService($keyword = '');
}
?>
