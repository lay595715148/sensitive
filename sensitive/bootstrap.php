<?php
/**
 * 统一入口文件
 * @author liaiyong
 */
if(!defined('INIT_SENSITIVE')) { exit; }

//Turn on output buffering
ob_start();
//start time
global $_StartTime;
$_secondArr = explode(' ', microtime());
$_StartTime = (float)$_secondArr[0] + (float)$_secondArr[1];

//sensitive源文件相对所在位置
global $_SRCPath;

require_once $_SRCPath.'/sensitive/function.php';
require_once $_SRCPath.'/sensitive/config.php';
require_once $_SRCPath.'/test/config.php';//额外的
global $_CFG;

//session init
if(array_key_exists('session-name',$_CFG) && $_CFG['session-name']) {
	//session_name($_CFG['session-name']);
	ini_set('session.name',$_CFG['session-name']);
}
if(array_key_exists('session-lifetime',$_CFG) && is_numeric($_CFG['session-lifetime'])) {
	$_sess = session_get_cookie_params();
	session_set_cookie_params(0,$_sess['path'],$_sess['domain'],$_sess['secure'],true);
	//ini_set('session.cookie_path',$_sess['path']);
	//ini_set('session.cookie_domain',$_sess['domain']);
	//ini_set('session.cookie_secure',true);
	//ini_set('session.cookie_httponly',true);
	ini_set('session.gc_maxlifetime',0+$_CFG['session-lifetime']);
}
if(array_key_exists('session-start',$_CFG) && $_CFG['session-start'] && (!array_key_exists('session-mysql',$_CFG) || !$_CFG['session-mysql'])) {
	session_start();
}

//类自动加载函数
function __autoload($name) {
    global $_CFG,$_SRCPath;
    if(!array_key_exists($name,$_CFG['classes'])) {
        throw new AutoloadException('No file reference for class:'.$name.'!');
    } else if(!file_exists($_SRCPath.$_CFG['classes'][$name])) {
        throw new AutoloadException('No file for class:'.$name.'!');
    } else {
        require_once $_SRCPath.$_CFG['classes'][$name];
    }
    if(!class_exists($name) && !interface_exists($name)) {
        throw new AutoloadException('No class:'.$name.' in file:'.$_SRCPath.$_CFG['classes'][$name]);
    }
}

//启动
try {
    Sensitive::start();
} catch (Exception $e) {
    echo '<pre>';print_r($e->getMessage()."\n");print_r($e->getTraceAsString());echo '</pre>';
}

if($_CFG['timing'] === true) {
    global $_EndTime;
    $_secondArr = explode(' ', microtime());
    $_EndTime = (float)$_secondArr[0] + (float)$_secondArr[1];
    echo '<pre>';echo 'start time: '.$_StartTime."\n".'end   time: '.$_EndTime;echo '</pre>';
}
?>
