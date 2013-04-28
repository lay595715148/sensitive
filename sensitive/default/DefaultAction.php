<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultAction extends AbstractAction {
    public function launch() {
        $this->defaultFunction();
    }
    public function defaultFunction() {
        $dtb = new DefaultTableBean();
        $bean = $dtb->rowsToArray(array(array('foo_field'=>1,'boo_field'=>'ti'), array('foo_field'=>2,'boo_field'=>'it')));
        if(array_key_exists('default',$this->services) && method_exists($this->services['default'],'defaultFunction')) {
            $data = $this->services['default']->defaultFunction();
        } else {
            $data = array();
        }
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
