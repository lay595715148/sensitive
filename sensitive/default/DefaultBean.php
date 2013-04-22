<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultBean extends AbstractBean {
	public function defaultFunction() {
		echo '<pre>';print_r($this);echo '</pre>';
	}
}
?>
