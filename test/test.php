<?php
/*header( 'Content-type: text/html; charset=utf-8' );
echo 'Begin ...<br />';
for( $i = 0 ; $i < 10 ; $i++ )
{
    echo $i . '<br />';
    flush();
    ob_flush();
    sleep(1);
}
echo 'End ...<br />';*/

define('INIT_SENSITIVE',true);
global $_SRCPath;
$_SRCPath = dirname(__FILE__).'/../';
require_once $_SRCPath.'/sensitive/bootstrap.php';
?>
