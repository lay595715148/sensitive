<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractStoreGen extends AbstractGen {
    public abstract function genStore($keyword = '');
}
?>
