<?php
/**
 * javascript加载
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * <p>javascript加载器</p>
 * <p>URL:  /*.js, /js/*.*</p>
 * <p>配置：</p>
 * 
 * @version 0.1.48 (bulid 130723)
 */
class JsAction extends AbstractAction {
	/**
	 * 默认执行方法
	 */
    public function launch() {
        global $_SRCPath;
        $ext = pathinfo($_SERVER['PHP_SELF']);
        $this->template->header('Content-Type:application/javascript');
        $this->template->file($_SRCPath.'/test/statics/js/'.$ext['filename'].'.js');
    }
}
?>
