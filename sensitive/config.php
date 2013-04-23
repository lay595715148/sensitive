<?php
if(!defined('INIT_SENSITIVE')) { exit; }

global $_CFG;

$_CFG['session-start']                      = false;
$_CFG['routes-start']                       = false;

$_CFG['action']['dispatch-key']             = 'key';
$_CFG['action']['dispatch-scope']           = 0;
$_CFG['action']['dispatch-style']           = '*';/* 会将*替换为dispatch-scope中dispatch-key值作为键的值 */
$_CFG['action']['dispatch-method']          = 'launch';//默认执行方法名

$_CFG['classes']['Sensitive']               = '/sensitive/Sensitive.php';
$_CFG['classes']['AbstractGen']             = '/sensitive/gen/AbstractGen.php';
$_CFG['classes']['AbstractActionGen']       = '/sensitive/gen/AbstractActionGen.php';
$_CFG['classes']['AbstractBeanGen']         = '/sensitive/gen/AbstractBeanGen.php';
$_CFG['classes']['AbstractServiceGen']      = '/sensitive/gen/AbstractServiceGen.php';
$_CFG['classes']['AbstractStoreGen']        = '/sensitive/gen/AbstractStoreGen.php';
$_CFG['classes']['AbstractTemplateGen']     = '/sensitive/gen/AbstractTemplateGen.php';
$_CFG['classes']['AbstractAction']          = '/sensitive/core/AbstractAction.php';
$_CFG['classes']['AbstractBase']            = '/sensitive/core/AbstractBase.php';
$_CFG['classes']['AbstractBean']            = '/sensitive/core/AbstractBean.php';
$_CFG['classes']['AbstractService']         = '/sensitive/core/AbstractService.php';
$_CFG['classes']['AbstractStore']           = '/sensitive/core/AbstractStore.php';
$_CFG['classes']['AbstractTemplate']        = '/sensitive/core/AbstractTemplate.php';
$_CFG['classes']['DefaultActionGen']        = '/sensitive/default/DefaultActionGen.php';
$_CFG['classes']['DefaultBeanGen']          = '/sensitive/default/DefaultBeanGen.php';
$_CFG['classes']['DefaultServiceGen']       = '/sensitive/default/DefaultServiceGen.php';
$_CFG['classes']['DefaultStoreGen']         = '/sensitive/default/DefaultStoreGen.php';
$_CFG['classes']['DefaultTemplateGen']      = '/sensitive/default/DefaultTemplateGen.php';
$_CFG['classes']['DefaultAction']           = '/sensitive/default/DefaultAction.php';
$_CFG['classes']['DefaultBean']             = '/sensitive/default/DefaultBean.php';
$_CFG['classes']['DefaultService']          = '/sensitive/default/DefaultService.php';
$_CFG['classes']['DefaultStore']            = '/sensitive/default/DefaultStore.php';
$_CFG['classes']['DefaultTableBean']        = '/sensitive/default/DefaultTableBean.php';
$_CFG['classes']['DefaultTemplate']         = '/sensitive/default/DefaultTemplate.php';

$_CFG['classes']['Mysql']                   = '/sensitive/store/Mysql.php';

$_CFG['classes']['Cell']                    = '/sensitive/util/Cell.php';
$_CFG['classes']['Condition']               = '/sensitive/util/Condition.php';
$_CFG['classes']['Arrange']                 = '/sensitive/util/Arrange.php';
$_CFG['classes']['File']                    = '/sensitive/util/File.php';
$_CFG['classes']['Transfer']                = '/sensitive/util/Transfer.php';
$_CFG['classes']['Scope']                   = '/sensitive/util/Scope.php';
$_CFG['classes']['Paging']                  = '/sensitive/util/Paging.php';
$_CFG['classes']['TableBean']               = '/sensitive/util/TableBean.php';

$_CFG['classes']['Security']                = '/sensitive/security/Security.php';

?>
