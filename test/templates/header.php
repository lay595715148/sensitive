<?php
if(!defined('INIT_SENSITIVE')) { exit; }
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php foreach($metas as $metaname=>$metacontent) { ?>
    <meta name="<?php echo $metaname;?>" content="<?php echo $metacontent;?>"/>
<?php } ?>
    <title><?php echo $title;?></title>
<?php foreach($csses as $css) { ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $css;?>"/>
<?php } ?>
<?php foreach($jses as $js) { ?>
    <script type="text/javascript" src="<?php echo $js;?>"></script>
<?php } ?>
</head>
<body>
<?php
?>
