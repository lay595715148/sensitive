<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class HomeAction extends AbstractAction {
	public function launch() {
        global $_SRCPath;
        $this->template->js('jquery.js?_r='.rand());
        $this->template->css('home.css?_r='.rand());
        $this->template->push('title','Home · Sensitive');
        $this->template->file($_SRCPath.'/test/templates/home.php');
	}
}
?>
