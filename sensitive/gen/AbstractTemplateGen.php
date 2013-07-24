<?php
/**
 * 模板对象生成器
 * @see https://github.com/lay595715148/sensitive
 * 
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 模板对象生成器
 * @abstract
 */
abstract class AbstractTemplateGen extends AbstractGen {
	/**
	 * 生成模板对象
	 * @abstract
	 * @param string $keyword 关键字
	 */
    public abstract function genTemplate($keyword = '');
}
?>
