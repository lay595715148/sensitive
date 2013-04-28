<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultAction extends AbstractAction {
    public function launch() {
        $this->defaultFunction();
    }
    public function defaultFunction() {
        $dtb = new DefaultTableBean();
        $bean = $dtb->rowsToArray(array(array('default_field'=>321,'default_field_2'=>'ti'), array('default_field'=>123,'default_field_2'=>'it')));
        $data = $this->services['default']->defaultFunction();
        $this->template->header('Content-Type: application/json');
        $this->template->header('Cache-Control: no-store');
        $this->template->push('bean',$bean);
        $this->template->push('data',$data);
    }
    public function tail() {//must return $this
        $this->template->json();
        return $this;
    }
}
?>
