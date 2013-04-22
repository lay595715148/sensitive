<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class DefaultActionGen extends AbstractActionGen {
    public function genAction($keyword = '') {
        global $_CFG;
        $ext = pathinfo($_SERVER['PHP_SELF']);
        $name = $ext['filename'];
        $classname = $ext['filename'].'Action';//默认对应的类名

        //在$_CFG['actions']中有以执行文件名配置属性，及classname属性对应的类存在
        if(array_key_exists($name,$_CFG['actions']) 
            && is_string($_CFG['actions'][$name]['classname']) 
            && class_exists($_CFG['actions'][$name]['classname'])) {
            $classname = $_CFG['actions'][$name]['classname'];
            $action = new $classname($_CFG['actions'][$name]);
        } else if(class_exists($classname)) {
            $action = new $classname();
        } else {
            $action = new DefaultAction();
        }

        return $action;
    }
}
?>
