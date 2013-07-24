<?php
/**
 * 默认数据模型对象生成器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认数据模型对象生成器
 * @author liaiyong
 */
class DefaultBeanGen extends AbstractBeanGen {
	/**
	 * 生成数据模型对象
	 * @param string $keyword 关键字
	 * @return AbstractBean
	 */
    public function genBean($keyword = '') {
        global $_CFG;
        $name = $keyword;
        $classname = ucfirst($name).'Bean';//默认对应的类名

        //在$_CFG['beans']中有以执行文件名配置属性，及classname属性对应的类存在
        if($name && array_key_exists($name,$_CFG['beans']) 
            && is_string($_CFG['beans'][$name]['classname']) 
            && class_exists($_CFG['beans'][$name]['classname'])) {
            $classname = $_CFG['beans'][$name]['classname'];
            $bean = new $classname();
			if(isset($_CFG['beans'][$name]['scope'])) {
				$bean->build($_CFG['beans'][$name]['scope']);
			} else {
				$bean->build();
			}
        } else if($name && array_key_exists($classname,$_CFG['classes'])) {
            $bean = new $classname();
			$bean->build();
        } else {
            $bean = new DefaultBean();
			$bean->build();
        }
        return $bean;
    }
}
?>
