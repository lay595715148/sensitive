<?php
class DefaultServiceGen extends AbstractServiceGen {
    public function genService($keyword = '') {
        global $_CFG;
        $name = $keyword;
        $classname = $name.'Service';//默认对应的类名

        //在$_CFG['services']中有以执行文件名配置属性，及classname属性对应的类存在
        if($name && array_key_exists($name,$_CFG['services']) 
            && is_string($_CFG['services'][$name]['classname']) 
            && class_exists($_CFG['services'][$name]['classname'])) {
            $classname = $_CFG['services'][$name]['classname'];
            $service = new $classname($_CFG['services'][$name]);
        } else if($name && class_exists($classname)) {
            $service = new $classname();
        } else {
            $service = new DefaultService();
        }
        return $service;
    }
}
?>
