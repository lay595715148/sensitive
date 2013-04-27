<?php
global $_CFG;

$_CFG['actions']['t']['classname'] = 'TestAction';
$_CFG['actions']['t']['services'] = array('test');
$_CFG['actions']['t']['beans'] = array('test');
$_CFG['actions']['js']['classname'] = array('JsAction');
$_CFG['actions']['css']['classname'] = array('CssAction');

$_CFG['beans']['test']['classname'] = 'TestBean';

$_CFG['services']['test']['classname'] = 'TestService';
$_CFG['services']['test']['store'] = 'mysql';

$_CFG['stores']['mysql']['classname'] = 'Mysql';
$_CFG['stores']['mysql']['host'] = '127.0.0.1';
$_CFG['stores']['mysql']['username'] = 'root';
$_CFG['stores']['mysql']['password'] = 'dcuxpasswd';
$_CFG['stores']['mysql']['database'] = 'sso';
$_CFG['stores']['mysql']['encoding'] = 'UTF8';
$_CFG['stores']['mysql']['showsql'] = true;

$_CFG['mapping']['tables']['DefaultTableBean'] = 'default';

$_CFG['mapping']['DefaultTableBean'] = array('defaultField'=>'default_field','defaultField2'=>'default_field_2');

$_CFG['classes']['TestAction'] = '/test/classes/actions/TestAction.php';
$_CFG['classes']['TestBean'] = '/test/classes/beans/TestBean.php';
$_CFG['classes']['TestService'] = '/test/classes/services/TestService.php';
$_CFG['classes']['JsAction'] = '/test/classes/actions/JsAction.php';
$_CFG['classes']['CssAction'] = '/test/classes/actions/CssAction.php';
?>
