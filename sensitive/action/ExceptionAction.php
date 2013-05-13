<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class ExceptionAction extends AbstractAction implements Interface_Grasp {
    public function launch() {
		$this->template->push('exception','this is a test exception');
		return $this;
	}
    public function grasp($e) {
		$this->template->push('exception',is_a($e, 'Exception')?$e->getMessage():'');
		return $this;
	}
	public function tail() {
        $this->template->header('Content-Type: text/xml');
		$this->template->xml();
		return $this;
	}
}
?>
