<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultAction extends AbstractAction {
    public function launch() {
        global $_SRCPath;
        $this->template->css('404.css?_r='.rand());
        $this->template->push('title','Page not found · Sensitive');
        $this->template->file($_SRCPath.'/test/templates/404.php');
    }
    public function tail() {//must return $this
        $this->template->out();
        return $this;
    }
}
?>
