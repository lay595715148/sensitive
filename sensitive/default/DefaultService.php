<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultService extends AbstractService {
	public function defaultFunction() {
		echo '<pre>';print_r($this);echo '</pre>';
		$this->store->defaultFunction();
	}
}
?>
