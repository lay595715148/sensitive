<?php
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 
 * @author liaiyong
 *
 */
class File extends AbstractBase {
	/**
	 * file write
	 * @param string $content
	 * @param string $dir
	 * @param string $basename
	 * @param string $mask
	 * @return boolean
	 */
    public static function write($content,$dir,$basename,$mask = '') {
        if(file_exists($dir)) {
            $filename = $basename.$mask;
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
     * @param string $file
     */
    public static function read($file) {
        $content = false;
        if(file_exists($file)) {
            $handle   = fopen($file,'r');
            $content  = fread($handle, filesize($file));
            $return   = fclose($handle);
        }
        return $content;
    }
}
?>
