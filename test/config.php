<?php
global $_CFG;

$_CFG['actions']['t']['classname'] = 'TestAction';
$_CFG['actions']['t']['services'] = array('test');
$_CFG['actions']['t']['beans'] = array('test');

$_CFG['actions']['tt'] = &$_CFG['actions']['t'];
$_CFG['actions']['ttt'] = &$_CFG['actions']['t'];

$_CFG['actions']['index']['classname'] = 'HomeAction';
$_CFG['actions']['index']['services'] = array('test');
$_CFG['actions']['index']['beans'] = array('test');
$_CFG['actions']['home'] = &$_CFG['actions']['index'];
$_CFG['actions']['default'] = &$_CFG['actions']['index'];

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

$_CFG['classes']['TestAction'] = '/test/classes/actions/TestAction.php';
$_CFG['classes']['TestBean'] = '/test/classes/beans/TestBean.php';
$_CFG['classes']['TestService'] = '/test/classes/services/TestService.php';

$_CFG['classes']['HomeAction'] = '/test/classes/actions/HomeAction.php';
?>
