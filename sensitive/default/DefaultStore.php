<?php
/**
 * 默认数据库访问类
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认数据库访问类
 * @author liaiyong
 */
class DefaultStore extends AbstractStore {
	/**
	 * 默认方法
	 */
	public function defaultFunction() {
		echo '<pre>';print_r($this);echo '</pre>';
	}
}
?>
