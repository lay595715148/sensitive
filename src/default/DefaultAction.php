<?php
class DefaultAction extends AbstractAction {
	public function launch() {
		$this->defaultFunction();
	}
	public function defaultFunction() {
		echo '<pre>';print_r($this);echo '</pre>';
	}
}
?>
