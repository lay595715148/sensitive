<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class TestAction extends AbstractAction {
	public function launch() {
        global $_SRCPath;
        $this->template->js('js?js=jquery&_r='.rand());
        $this->template->css('css?_r='.rand());
        $this->template->push('title','Test template');
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
        $this->template->out();
		echo "<pre>";print_r($this);echo "</pre>";
	}
}
?>
