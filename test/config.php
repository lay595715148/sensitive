<?php
global $_CFG;

$_CFG['actions']['index']['classname'] = 'DefaultAction';
$_CFG['actions']['index']['services'] = array('default');
$_CFG['actions']['index']['beans'] = array('default');

$_CFG['beans']['default']['classname'] = 'DefaultBean';

$_CFG['services']['default']['classname'] = 'DefaultService';
$_CFG['services']['default']['store'] = 'default';

$_CFG['stores']['default']['classname'] = 'Mysql';
$_CFG['stores']['default']['host'] = '127.0.0.1';
$_CFG['stores']['default']['username'] = 'root';
$_CFG['stores']['default']['password'] = 'dcuxpasswd';
$_CFG['stores']['default']['database'] = 'sso';
$_CFG['stores']['default']['encoding'] = 'UTF8';
$_CFG['stores']['default']['showsql'] = true;

$_CFG['mapping']['tables']['DefaultTableBean'] = 'default';

$_CFG['mapping']['DefaultTableBean'] = array('defaultField'=>'default_field','defaultField2'=>'default_field_2');
?>
