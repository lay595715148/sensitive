<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class CssAction extends AbstractAction {
    public function launch() {
        global $_SRCPath;
        $ext = pathinfo($_SERVER['PHP_SELF']);
        $this->template->header('Content-Type:text/css');
        $this->template->file($_SRCPath.'/test/statics/css/'.$ext['filename'].'.css');
    }
}
?>
