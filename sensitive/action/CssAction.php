<?php
/**
 * css加载
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * <p>css加载器</p>
 * <p>URL:  /*.css, /css/*.*</p>
 * <p>配置：</p>
 * 
 * @version 0.1.48 (bulid 130723)
 */
class CssAction extends AbstractAction {
	/**
	 * 默认执行方法
	 */
    public function launch() {
        global $_SRCPath;
        $ext = pathinfo($_SERVER['PHP_SELF']);
        $this->template->header('Content-Type:text/css');
        $this->template->file($_SRCPath.'/test/statics/css/'.$ext['filename'].'.css');
    }
}
?>
