<?php
/**
 * 业务逻辑处理对象基础类
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 业务逻辑处理对象基础类
 * @abstract
 * @version 0.1.48 (bulid 130723)
 */
abstract class AbstractService extends AbstractBase {
	/**
	 * 配置信息数组
	 * @var array
	 */
    protected $config;
    /**
     * 一个AbstacrtBase对象
     * @var AbstacrtBase
     */
    protected $store;
	/**
	 * 构造方法
	 * @param array $config
	 */
    public function __construct($config = '') {
        $this->config = $config;
	}
	/**
	 * 初始化
	 */
    public function init() {
        //echo 'AbstractService init';
        $config     = &$this->config;
        $store      = &$this->store;
        $storeGen   = new DefaultStoreGen();

        if(is_array($config) && array_key_exists('store',$config) && $config['store'] && is_string($config['store'])) {
            //加载配置中的store
            $store = $storeGen->genStore($config['store'])->init();
        } else {
            $store = $storeGen->genStore()->init();
        }
		return $this;
    }
}
?>
