<?php
/**
 * 数据库访问对象生成器
 * @see https://github.com/lay595715148/sensitive
 * 
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 数据库访问对象生成器
 * @abstract
 */
abstract class AbstractStoreGen extends AbstractGen {
	/**
	 * 生成数据库访问对象
	 * @abstract
	 * @param string $keyword 关键字
	 */
    public abstract function genStore($keyword = '');
}
?>
