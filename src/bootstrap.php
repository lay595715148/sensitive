<?php
/**
 * @author liaiyong
 */
//Turn on output buffering
ob_start();
//start time
global $_StartTime;
$_secondArr = explode(" ", microtime());
$_StartTime = (float)$_secondArr[0] + (float)$_secondArr[1];

//src相对所在位置
global $_SRCPath;

require_once $_SRCPath.'src/config.php';
//require_once $_SRCPath.'test/config.php';//额外的
global $_CFG;

if($_CFG['session-start']) { session_start(); }

//autoload function
function __autoload($name) {
    global $_CFG,$_SRCPath;
    if(array_key_exists($name,$_CFG['classes'])) {
        require_once $_SRCPath.$_CFG['classes'][$name];
    } else {
        //throw new AutoloadException("No file for class:'$classname'!");
    }
    if(!class_exists($name) && !interface_exists($name)) {
        //throw new AutoloadException("No class:'$classname'!");
    }
}

Sensitive::start();
?>
