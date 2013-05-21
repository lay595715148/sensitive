<?php
if(!defined('INIT_SENSITIVE')) { exit; }

global $_CFG,$_LAN;

$_CFG['timing']                             = false;
$_CFG['session-start']                      = false;
$_CFG['session-mysql']                      = true;
$_CFG['session-name']                       = '';
$_CFG['session-lifetime']                   = 1800;
$_CFG['routes-start']                       = false;
$_CFG['try-exception']                      = false;

//配置主题，相对于$_SRCPath
$_CFG['theme']['theme-dir']                 = '';//相对$_SRCPath
$_CFG['theme']['theme-use']                 = 'default';
$_CFG['themes']['default']['dir']           = '/test';//相对$_CFG['theme']['theme-dir']
$_CFG['themes']['default']['tpl']           = '/test/templates';//相对$_CFG['theme']['theme-dir']

//配置action
$_CFG['action']['dispatch-key']             = '';//false时，使用请求文件名来路由action中的方法
$_CFG['action']['dispatch-scope']           = 0;//0指$_REQUEST,详细见Scope类
$_CFG['action']['dispatch-style']           = '*';/* 会将*替换为dispatch-scope中dispatch-key值作为键的值 */
$_CFG['action']['dispatch-method']          = 'launch';//默认执行方法名

//配置类文件映射，相对于$_SRCPath
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

$_CFG['classes']['Interface_Grasp']         = '/sensitive/core/Interface_Grasp.php';

$_CFG['classes']['Mysql']                   = '/sensitive/store/Mysql.php';

$_CFG['classes']['Cell']                    = '/sensitive/util/Cell.php';
$_CFG['classes']['Condition']               = '/sensitive/util/Condition.php';
$_CFG['classes']['Arrange']                 = '/sensitive/util/Arrange.php';
$_CFG['classes']['File']                    = '/sensitive/util/File.php';
$_CFG['classes']['Transfer']                = '/sensitive/util/Transfer.php';
$_CFG['classes']['Scope']                   = '/sensitive/util/Scope.php';
$_CFG['classes']['Paging']                  = '/sensitive/util/Paging.php';
$_CFG['classes']['TableBean']               = '/sensitive/util/TableBean.php';
$_CFG['classes']['Parser']                  = '/sensitive/util/Parser.php';
$_CFG['classes']['Util']                    = '/sensitive/util/Util.php';

$_CFG['classes']['Security']                = '/sensitive/security/Security.php';

$_CFG['classes']['JsAction']                = '/sensitive/action/JsAction.php';
$_CFG['classes']['CssAction']               = '/sensitive/action/CssAction.php';
$_CFG['classes']['ExceptionAction']         = '/sensitive/action/ExceptionAction.php';

//配置表结构映射
$_CFG['mapping']['tables']['DefaultTableBean'] = 'default';
$_CFG['mapping']['DefaultTableBean'] = array('foo'=>'foo_field','boo'=>'boo_field');
//配置业务结构映射
$_CFG['actions']['default']['classname'] = 'DefaultAction';
$_CFG['actions']['default']['services'] = array('default');
$_CFG['actions']['default']['beans'] = array('default');
$_CFG['actions']['exception']['classname'] = 'ExceptionAction';
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
$_CFG['actions']['index'] = &$_CFG['actions']['default'];

$_CFG['LAN'] = array();

$_LAN = &$_CFG['LAN'];
?>
