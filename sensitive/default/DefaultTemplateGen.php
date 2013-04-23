<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultTemplateGen extends AbstractTemplateGen {
    public function genTemplate($keyword = '') {
        return new DefaultTemplate();
    }
}
?>
