<?php
/**
 * 默认业务逻辑处理对象生成器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认业务逻辑处理对象生成器
 * @author liaiyong
 */
class DefaultServiceGen extends AbstractServiceGen {
	/**
	 * 生成业务逻辑处理对象
	 * @param string $keyword 关键字
	 * @return AbstractService
	 */
    public function genService($keyword = '') {
        global $_CFG;
        $name = $keyword;
        $classname = ucfirst($name).'Service';//默认对应的类名

        //在$_CFG['services']中有以执行文件名配置属性，及classname属性对应的类存在
        if($name && array_key_exists($name,$_CFG['services']) 
            && is_string($_CFG['services'][$name]['classname']) 
            && class_exists($_CFG['services'][$name]['classname'])) {
            $classname = $_CFG['services'][$name]['classname'];
            $service = new $classname($_CFG['services'][$name]);
        } else if($name && array_key_exists($classname,$_CFG['classes'])) {
            $service = new $classname();
        } else {
            $service = new DefaultService();
        }
        return $service;
    }
}
?>
