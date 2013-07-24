<?php
/**
 * '异常'控制器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * <p>'异常'控制器</p>
 * <p>URL：/exception, /exception.*</p>
 * <p>配置：$_CFG['actions']['exception']['classname'] = 'ExceptionAction';</p>
 * 
 * @version 0.1.48 (bulid 130723)
 */
class ExceptionAction extends AbstractAction implements Interface_Grasp {
	/**
	 * 默认执行方法
	 */
    public function launch() {
		$this->template->push('exception','this is a test exception');
		return $this;
	}
	/**
	 * 异常抓取处理
	 * @param Exception $e
	 */
    public function grasp($e) {
		$this->template->push('exception',is_a($e, 'Exception')?$e->getMessage():'');
		return $this;
	}
	/**
	 * 最后执行方法
	 */
	public function tail() {
		$this->template->header('Content-Type: application/json');
		$this->template->header('Cache-Control: no-store');
		$this->template->json();
		return $this;
	}
}
?>
