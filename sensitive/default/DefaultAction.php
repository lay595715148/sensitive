<?php
/**
 * 默认控制器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认控制器
 * @author liaiyong
 */
class DefaultAction extends AbstractAction {
	/**
	 * 默认执行方法
	 */
    public function launch() {
        global $_SRCPath;
        $this->template->css('404.css?_r='.rand());
        $this->template->push('title','Page not found · Sensitive');
        $this->template->template('/404.php');
    }
	/**
	 * 最后执行方法
	 */
    public function tail() {//must return $this
        $this->template->out();
        return $this;
    }
}
?>
