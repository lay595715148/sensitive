<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultStore extends AbstractStore {
	public function defaultFunction() {
		echo '<pre>';print_r($this);echo '</pre>';
	}
}
?>
