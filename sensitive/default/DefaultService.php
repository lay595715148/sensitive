<?php
/**
 * 默认业务逻辑处理类
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认业务逻辑处理类
 * @author liaiyong
 */
class DefaultService extends AbstractService {
	/**
	 * 默认方法
	 */
    public function defaultFunction() {
        return array('mysql','mysqli');
    }
}
?>
