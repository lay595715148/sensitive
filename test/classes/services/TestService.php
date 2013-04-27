<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class TestService extends AbstractService {
    public function test() {
        echo "<pre>TestService</pre>";
    }
}
?>
