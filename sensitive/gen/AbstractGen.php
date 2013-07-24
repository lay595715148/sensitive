<?php
/**
 * 对象生成器基础类
 * @see https://github.com/lay595715148/sensitive
 * 
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 对象生成器基础类
 * @abstract
 */
abstract class AbstractGen extends AbstractBase {
	/**
	 * 生成对象
	 * @abstract
	 * @param string $name 类名
	 */
    public function gen($name = '') {
    }
}
?>
