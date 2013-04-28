<?php
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 主类,
 * 
 * @author liaiyong
 */
class Sensitive extends AbstractBase {
    private static $Instance = null;
    private function __construct() { }
    public static function getInstance() {
        if(self::$Instance === null) {
            self::$Instance = new Sensitive();
        }
        return self::$Instance;
    }
    public static function start() {
        $instance = Sensitive::getInstance();
        $instance->run();
    }
    public function run() {
        global $_CFG;
        $actionGen = new DefaultActionGen();
        $action    = $actionGen->genAction()->init()->dispatch()->tail();
    }
}

class AutoloadException extends Exception {}
?>
