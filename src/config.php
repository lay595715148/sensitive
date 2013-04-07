<?php
global $_CFG;
$_CFG['session-start']                      = false;
$_CFG['routes-start']                       = false;

$_CFG['action']['auto-dispatch']            = true;
$_CFG['action']['dispatch-key']             = 'key';
$_CFG['action']['dispatch-scope']           = 0;
$_CFG['action']['dispatch-style']           = 'do*';/* 会将*替换为dispatch-scope中dispatch-key值作为键的值 */
$_CFG['action']['dispatch-method']          = 'launch';

$_CFG['classes']['Sensitive']               = '/src/Sensitive.php';
$_CFG['classes']['AbstractGen']             = '/src/gen/AbstractGen.php';
$_CFG['classes']['AbstractActionGen']       = '/src/gen/AbstractActionGen.php';
$_CFG['classes']['AbstractBeanGen']         = '/src/gen/AbstractBeanGen.php';
$_CFG['classes']['AbstractServiceGen']      = '/src/gen/AbstractServiceGen.php';
$_CFG['classes']['AbstractStoreGen']        = '/src/gen/AbstractStoreGen.php';
$_CFG['classes']['AbstractAction']          = '/src/core/AbstractAction.php';
$_CFG['classes']['AbstractBase']            = '/src/core/AbstractBase.php';
$_CFG['classes']['AbstractBean']            = '/src/core/AbstractBean.php';
$_CFG['classes']['AbstractService']         = '/src/core/AbstractService.php';
$_CFG['classes']['AbstractStore']           = '/src/core/AbstractStore.php';
$_CFG['classes']['DefaultActionGen']        = '/src/default/DefaultActionGen.php';
$_CFG['classes']['DefaultBeanGen']          = '/src/default/DefaultBeanGen.php';
$_CFG['classes']['DefaultServiceGen']       = '/src/default/DefaultServiceGen.php';
$_CFG['classes']['DefaultStoreGen']         = '/src/default/DefaultStoreGen.php';
$_CFG['classes']['DefaultAction']           = '/src/default/DefaultAction.php';
$_CFG['classes']['DefaultBean']             = '/src/default/DefaultBean.php';
$_CFG['classes']['DefaultService']          = '/src/default/DefaultService.php';
$_CFG['classes']['DefaultStore']            = '/src/default/DefaultStore.php';

$_CFG['classes']['Mysql']                   = '/src/store/Mysql.php';

$_CFG['classes']['Cell']                    = '/src/util/Cell.php';
$_CFG['classes']['Condition']               = '/src/util/Condition.php';
$_CFG['classes']['Arrange']                 = '/src/util/Arrange.php';
$_CFG['classes']['File']                    = '/src/util/File.php';
$_CFG['classes']['Transfer']                = '/src/util/Transfer.php';
$_CFG['classes']['Paging']                  = '/src/util/Paging.php';

//haven't used
$_CFG['classes']['AltoRouter']              = '/src/route/AltoRouter.php';
$_CFG['classes']['Route']                   = '/src/route/Route.php';
$_CFG['classes']['Router']                  = '/src/route/Router.php';
$_CFG['classes']['Dispatcher']              = '/src/route/Dispatcher.php';

$_CFG['routes'][]                           = array('pattern'=>'/', 'args'=>array('name'=>'home'));
$_CFG['routes'][]                           = array('pattern'=>'/users/', 'args'=>array('name'=>'users_list', 'methods' => 'GET,PUT'));
$_CFG['routes'][]                           = array('pattern'=>'/user/:userid/', 'args'=>array('name'=>'user_select', 'methods' => 'GET,PUT'));
$_CFG['routes'][]                           = array('pattern'=>'/user/:userid/update', 'args'=>array('name'=>'user_update', 'methods' => 'GET,POST,PUT'));
$_CFG['routes'][]                           = array('pattern'=>'/user/:userid/delete', 'args'=>array('name'=>'user_delete', 'methods' => 'GET,POST,PUT,DELETE'));
$_CFG['routes'][]                           = array('pattern'=>'/user/:userid/insert', 'args'=>array('name'=>'user_insert', 'methods' => 'GET,POST,PUT'));
$_CFG['routes'][]                           = array('pattern'=>'/user/:userid/create', 'args'=>array('name'=>'user_create', 'methods' => 'GET,PUT'));
$_CFG['routes'][]                           = array('pattern'=>'/user/:userid/edit', 'args'=>array('name'=>'user_edit', 'methods' => 'GET,PUT'));
?>
