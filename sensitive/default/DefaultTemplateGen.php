<?php
/**
 * 默认模板引擎对象生成器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认模板引擎对象生成器
 * @author liaiyong
 */
class DefaultTemplateGen extends AbstractTemplateGen {
	/**
	 * 生成模板引擎对象
	 * @param string $keyword 关键字
	 * @return AbstractTemplate
	 */
    public function genTemplate($keyword = '') {
        return new DefaultTemplate();
    }
}
?>
