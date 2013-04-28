<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class TestAction extends AbstractAction {
    public function init() {//must return $this
        global $_CFG;
        /**
         * 设置dispatch-key，使用$_REQUEST中以此为键的值作为方法路由
         * 如果：$_CFG['action']['dispatch-key'] = '_';
         *      则，t?_=tt    =>   TestAction::tt()
         * 如果：$_CFG['action']['dispatch-key'] = '';
         *      则，t?_=tt    =>   TestAction::t()
         */
        //$_CFG['action']['dispatch-key'] = '_';
        return parent::init();
    }
	public function launch() {
        global $_SRCPath;
        $dtb = new DefaultTableBean();
        $bean = $dtb->rowsToArray(array(array('foo_field'=>1,'boo_field'=>'ti'), array('foo_field'=>2,'boo_field'=>'it')));
        $this->template->push('bean',$bean);
        $this->template->js('jquery.js?_r='.rand());
        $this->template->css('style.css?_r='.rand());
        $this->template->push('title','测试> template');
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
	}
    public function t() {
        global $_SRCPath;
        $array = Parser::xml2Array(File::read($_SRCPath.'/test/statics/ExportMessages.xml'));
        $this->template->header('Content-Type:text/html');
        $this->template->js('js.js?_r='.rand());
        $this->template->css('style.css?_r='.rand());
        $this->template->push('title','T');
        $this->template->push('array',$array);
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
    }
    public function tt() {
        global $_SRCPath;
        $this->template->js('jquery.js?_r='.rand());
        $this->template->css('style.css?_r='.rand());
        $this->template->push('title','TT');
        $this->template->push('testname',array('name'=>'value'));
        $this->template->file($_SRCPath.'/test/templates/test.php');
    }
}
?>
