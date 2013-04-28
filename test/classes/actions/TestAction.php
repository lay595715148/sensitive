<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class TestAction extends AbstractAction {
    public function init() {//must return $this
        global $_CFG;
        $_CFG['action']['dispatch-key'] = '_';
        return parent::init();
    }
	public function launch() {
        global $_SRCPath;
        $this->template->js('jquery.js?_r='.rand());
        $this->template->css('style.css?_r='.rand());
        $this->template->push('title','Test template');
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
		//echo "<pre>";print_r($this);echo "</pre>";
	}
    public function t() {
        global $_SRCPath;
        $this->template->header('Content-Type:text/html');
        $this->template->js('js.js?_r='.rand());
        $this->template->css('style.css?_r='.rand());
        $this->template->push('title','T');
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
    }
    public function tt() {
        global $_SRCPath;
        $this->template->js('jquery.js?_r='.rand());
        $this->template->css('style.css?_r='.rand());
        $this->template->push('title','TT');
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
    }
}
?>
