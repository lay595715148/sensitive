<?php
global $_CFG;
/*
$_CFG['action']                             = array();
$_CFG['actions']                            = array();
$_CFG['bean']                               = array();
$_CFG['beans']                              = array();
$_CFG['service']                            = array();
$_CFG['services']                           = array();
$_CFG['store']                              = array();
$_CFG['stores']                             = array();
$_CFG['mapping']                            = array();
$_CFG['classes']                            = array();

$_CFG['mapping']['tables']                  = array();
*/
$_CFG['session-start']                      = false;

$_CFG['action']['auto-dispatch']            = true;
$_CFG['action']['dispatch-key']             = 'key';
$_CFG['action']['dispatch-scope']           = 0;
$_CFG['action']['dispatch-style']           = 'do*';/* 会将*替换为dispatch-scope中dispatch-key值作为键的值 */
$_CFG['action']['dispatch-method']          = 'launch';

$_CFG['classes']['Sensitive']               = 'src/Sensitive.php';
$_CFG['classes']['AbstractGen']             = 'src/gen/AbstractGen.php';
$_CFG['classes']['AbstractActionGen']       = 'src/gen/AbstractActionGen.php';
$_CFG['classes']['AbstractBeanGen']         = 'src/gen/AbstractBeanGen.php';
$_CFG['classes']['AbstractServiceGen']      = 'src/gen/AbstractServiceGen.php';
$_CFG['classes']['AbstractStoreGen']        = 'src/gen/AbstractStoreGen.php';
$_CFG['classes']['AbstractAction']          = 'src/core/AbstractAction.php';
$_CFG['classes']['AbstractBase']            = 'src/core/AbstractBase.php';
$_CFG['classes']['AbstractBean']            = 'src/core/AbstractBean.php';
$_CFG['classes']['AbstractService']         = 'src/core/AbstractService.php';
$_CFG['classes']['AbstractStore']           = 'src/core/AbstractStore.php';
$_CFG['classes']['DefaultActionGen']        = 'src/default/DefaultActionGen.php';
$_CFG['classes']['DefaultServiceGen']       = 'src/default/DefaultServiceGen.php';
$_CFG['classes']['DefaultStoreGen']         = 'src/default/DefaultStoreGen.php';
$_CFG['classes']['DefaultAction']           = 'src/default/DefaultAction.php';
$_CFG['classes']['DefaultService']          = 'src/default/DefaultService.php';
$_CFG['classes']['DefaultStore']            = 'src/default/DefaultStore.php';
?>
