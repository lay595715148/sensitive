<?php
class DefaultService extends AbstractService {
	public function defaultFunction() {
		echo '<pre>';print_r($this);echo '</pre>';
		$this->store->defaultFunction();
	}
}
?>
