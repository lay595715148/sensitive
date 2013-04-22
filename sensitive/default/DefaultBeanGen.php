<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultBeanGen extends AbstractBeanGen {
    public function genBean($keyword = '') {
        global $_CFG;
        $name = $keyword;
        $classname = ucwords($name).'Bean';//默认对应的类名

        //在$_CFG['beans']中有以执行文件名配置属性，及classname属性对应的类存在
        if($name && array_key_exists($name,$_CFG['beans']) 
            && is_string($_CFG['beans'][$name]['classname']) 
            && class_exists($_CFG['beans'][$name]['classname'])) {
            $classname = $_CFG['beans'][$name]['classname'];
            $bean = new $classname($_CFG['beans'][$name]);
        } else if($name && class_exists($classname)) {
            $bean = new $classname();
        } else {
            $bean = new DefaultBean();
        }
        return $bean;
    }
}
?>
