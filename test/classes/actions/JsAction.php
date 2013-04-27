<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class JsAction extends AbstractAction {
	public function launch() {
        global $_SRCPath;
        $this->template->header('Content-Type:application/javascript');
        $this->template->file($_SRCPath.'/test/statics/js/'.$_REQUEST['js'].'.js');
        $this->template->out();
	}
}
?>
