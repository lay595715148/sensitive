<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractActionGen extends AbstractGen {
    public abstract function genAction($keyword = '');
}
?>
