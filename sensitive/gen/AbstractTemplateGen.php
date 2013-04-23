<?php
if(!defined('INIT_SENSITIVE')) { exit; }

abstract class AbstractTemplateGen extends AbstractGen {
    public abstract function genTemplate($keyword = '');
}
?>
