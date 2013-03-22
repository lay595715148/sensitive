<?php
global $_CFG;

$_CFG['action'] = array();
$_CFG['actions'] = array();
$_CFG['bean'] = array();
$_CFG['beans'] = array();
$_CFG['service'] = array();
$_CFG['services'] = array();
$_CFG['store'] = array();
$_CFG['stores'] = array();
$_CFG['mapping'] = array();
$_CFG['mapping']['tables'] = array();
$_CFG['classes'] = array();

$_CFG['action']['auto-dispatch'] = true;
$_CFG['action']['dispatch-key'] = 'key';
$_CFG['action']['dispatch-scope'] = 0;
$_CFG['action']['dispatch-style'] = 'do*';/* 会将*替换为dispatch-scope中dispatch-key值作为键的值 */

//require_once '../test/config.php';
?>
