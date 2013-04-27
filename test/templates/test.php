<?php
if(!defined('INIT_SENSITIVE')) { exit; }
include $_SRCPath.'/test/templates/header.php';
?>
<pre>
<?php print_r($testname);?>
</pre>
<?php
include $_SRCPath.'/test/templates/footer.php';
?>
