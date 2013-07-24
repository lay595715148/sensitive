<?php
/**
 * 文件处理相关工具类
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 文件处理相关工具类
 * @author liaiyong
 */
class File extends AbstractBase {
	/**
	 * file write
	 * @param string $content
	 * @param string $dir
	 * @param string $name
	 * @param string $mask
	 * @return boolean
	 */
    public static function write($content,$dir,$name,$mask = '') {
        if(file_exists($dir)) {
            $filename = $name.$mask;
            $handle   = fopen($dir.'/'.$filename,'w');
            $result   = fwrite($handle,$content);
            $return   = fflush($handle);
            $return   = fclose($handle);
            return $result;
        } else {
            return false;
        }
    }
    /**
     * file read
     * @param string $name
     * @param string $dir
     * @param string $mask
     * @return string
     */
    public static function read($name,$dir,$mask = '') {
        $content = false;
        $file = $dir.'/'.$name.$mask;
        if(file_exists($file)) {
            $handle   = fopen($file,'r');
            $content  = fread($handle, filesize($file));
            $return   = fclose($handle);
        }
        return $content;
    }
}
?>
