<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultStoreGen extends AbstractStoreGen {
    public function genStore($keyword = '') {
        global $_CFG;
        $name = $keyword;
        $classname = ucwords($name).'Store';//默认对应的类名

        //在$_CFG['stores']中有以执行文件名配置属性，及classname属性对应的类存在
        if($name && array_key_exists($name,$_CFG['stores']) 
            && is_string($_CFG['stores'][$name]['classname']) 
            && class_exists($_CFG['stores'][$name]['classname'])) {
            $classname = $_CFG['stores'][$name]['classname'];
            $store = new $classname($_CFG['stores'][$name]);
        } else if($name && class_exists($classname)) {
            $store = new $classname();
        } else {
            $store = new DefaultStore();
        }
        return $store;
    }
}
?>
