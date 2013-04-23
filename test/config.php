<?php
global $_CFG;

$_CFG['actions']['t']['classname'] = 'DefaultAction';
$_CFG['actions']['t']['services'] = array('default');
$_CFG['actions']['t']['beans'] = array('default');

$_CFG['beans']['default']['classname'] = 'DefaultBean';

$_CFG['services']['default']['classname'] = 'DefaultService';
$_CFG['services']['default']['store'] = 'mysql';

$_CFG['stores']['mysql']['classname'] = 'Mysql';
$_CFG['stores']['mysql']['host'] = '127.0.0.1';
$_CFG['stores']['mysql']['username'] = 'root';
$_CFG['stores']['mysql']['password'] = 'dcuxpasswd';
$_CFG['stores']['mysql']['database'] = 'sso';
$_CFG['stores']['mysql']['encoding'] = 'UTF8';
$_CFG['stores']['mysql']['showsql'] = true;

$_CFG['mapping']['tables']['DefaultTableBean'] = 'default';

$_CFG['mapping']['DefaultTableBean'] = array('defaultField'=>'default_field','defaultField2'=>'default_field_2');
?>
