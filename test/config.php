<?php
global $_CFG;

$_CFG['actions']['index']['classname'] = 'DefaultAction';
$_CFG['actions']['index']['services'] = array('default','defaultService');
$_CFG['actions']['index']['beans'] = array('default','defaultBean');

$_CFG['beans']['default']['classname'] = 'DefaultBean';
$_CFG['beans']['defaultBean']['classname'] = 'DefaultBean';

$_CFG['services']['default']['classname'] = 'DefaultService';
$_CFG['services']['default']['store'] = 'defaultService';
$_CFG['services']['defaultService']['classname'] = 'DefaultService';
$_CFG['services']['defaultService']['store'] = 'default';

$_CFG['stores']['defaultService']['classname'] = 'DefaultStore';
$_CFG['stores']['default']['classname'] = 'DefaultStore';
?>
