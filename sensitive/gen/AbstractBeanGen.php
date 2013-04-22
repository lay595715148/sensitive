<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractBeanGen extends AbstractGen {
    public abstract function genBean($keyword = '');
}
?>
