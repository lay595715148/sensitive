<?php
/**
 * 数据库访问对象基础类
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 数据库访问对象基础类
 * @abstract
 * @version 0.1.48 (bulid 130723)
 */
abstract class AbstractStore extends AbstractBase {
	/**
	 * 配置信息数组
	 * @var array
	 */
    protected $config;
    /**
     * 构造方法
     * @param array $config 配置信息数组
     */
    public function __construct($config = '') {
        $this->config = $config;
    }
    /**
     * 初始化
     */
    public function init() {
        //echo 'AbstractStore init';
        return $this;
    }
}
?>
