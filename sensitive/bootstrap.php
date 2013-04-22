<?php
/**
 * 统一入口
 * @author liaiyong
 */
define('INIT_SENSITIVE',true);

//Turn on output buffering
ob_start();
//start time
global $_StartTime;
$_secondArr = explode(' ', microtime());
$_StartTime = (float)$_secondArr[0] + (float)$_secondArr[1];

//sensitive源文件相对所在位置
global $_SRCPath;

require_once $_SRCPath.'/sensitive/config.php';
require_once $_SRCPath.'/test/config.php';//额外的
global $_CFG;

if($_CFG['session-start']) { session_start(); }

//类自动加载函数
function __autoload($name) {
    global $_CFG,$_SRCPath;
    if(array_key_exists($name,$_CFG['classes'])) {
        require_once $_SRCPath.$_CFG['classes'][$name];
    } else {
        throw new AutoloadException('No file for class:'.$name.'!');
    }
    if(!class_exists($name) && !interface_exists($name)) {
     
        throw new AutoloadException('No class:'.$name.'!');
    }
}

//启动
try {
	Sensitive::start();
} catch (Exception $e) {
	echo '<pre>';print_r($e->getMessage()."\n");print_r($e->getTraceAsString());echo '</pre>';
}
?>
