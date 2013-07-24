<?php
/**
 * 默认控制器对象生成器
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 默认控制器对象生成器
 * @author liaiyong
 */
class DefaultActionGen extends AbstractActionGen {
	/**
	 * 生成控制器对象
	 * @param string $keyword 关键字
	 * @return AbstractAction
	 */
    public function genAction($keyword = '') {
        global $_CFG;
        $ext = pathinfo(($keyword && is_string($keyword))?$keyword:$_SERVER['PHP_SELF']);
        $dirname = substr($ext['dirname'],11);
        $filename = $ext['filename'];
        $extension = array_key_exists('extension',$ext)?$ext['extension']:'';
        if($dirname != '' && ($dirname === 'js' || $dirname === 'css')) {
            $classname = ucfirst($dirname).'Action';//对应的类名
            $action = new $classname();
        } else if($extension === 'js' || $extension === 'css') {
            $classname = ucfirst($extension).'Action';//对应的类名
            $action = new $classname();
        } else {
            $classname = ucfirst($filename).'Action';//默认对应的类名

            //在$_CFG['actions']中有以执行文件名配置属性，及classname属性对应的类存在
            if(array_key_exists($filename,$_CFG['actions']) 
                && is_string($_CFG['actions'][$filename]['classname']) 
                && class_exists($_CFG['actions'][$filename]['classname'])) {
                $classname = $_CFG['actions'][$filename]['classname'];
                $action = new $classname($_CFG['actions'][$filename]);
            } else if(array_key_exists($classname,$_CFG['classes'])) {
                $action = new $classname();
            } else {
                $action = new DefaultAction($_CFG['actions']['default']);
            }
        }

        return $action;
    }
}
?>
