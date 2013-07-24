<?php
/**
 * 异常抓取接口
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 异常抓取接口
 * @interface
 */
interface Interface_Grasp {
	/**
	 * 异常抓取
	 * @param Exception $e
	 */
    public function grasp($e);//must return $this
}
?>
