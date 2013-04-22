<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultAction extends AbstractAction {
	public function launch() {
		$this->defaultFunction();
	}
	public function defaultFunction() {
		//echo '<pre>';print_r($this);echo '</pre>';
		/*$paging = new Paging();
		$paging->build(array('page'=>8,'pageSize'=>20,'count'=>1872))->carry();
		echo '<pre>';print_r($paging->toArray());echo '</pre>';*/
		$dtb = new DefaultTableBean();
		echo '<pre>';print_r( $dtb->rowsToArray(array(array('default_field'=>321,'default_field_2'=>'ti'), array('default_field'=>123,'default_field_2'=>'it'))) );echo '</pre>';
		echo '<pre>';print_r( $dtb->toArray() );echo '</pre>';
		$this->services['default']->defaultFunction();
	}
}
?>
