<?php
/**
 * 默认数据库访问对象生成器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认数据库访问对象生成器
 * @author liaiyong
 */
class DefaultStoreGen extends AbstractStoreGen {
	/**
	 * 生成数据库访问对象
	 * @param string $keyword 关键字
	 * @return AbstractStore
	 */
    public function genStore($keyword = '') {
        global $_CFG;
        $name = $keyword;
        $classname = ucfirst($name).'Store';//默认对应的类名

        //在$_CFG['stores']中有以执行文件名配置属性，及classname属性对应的类存在
        if($name && array_key_exists($name,$_CFG['stores']) 
            && is_string($_CFG['stores'][$name]['classname']) 
            && class_exists($_CFG['stores'][$name]['classname'])) {
            $classname = $_CFG['stores'][$name]['classname'];
            $store = new $classname($_CFG['stores'][$name]);
        } else if($name && array_key_exists($classname,$_CFG['classes'])) {
            $store = new $classname();
        } else {
            $store = new DefaultStore();
        }
        return $store;
    }
}
?>
