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
        global $_CFG;
        $instance = Sensitive::getInstance();
		$instance->run();
    }
    public function run() {
        global $_CFG;
        $actionGen = new DefaultActionGen();
        if($_CFG['try-excption'] === true) {
			try {
				$actionGen->genAction()->init()->dispatch()->tail();
			} catch(Exception $e) {
				$actionGen->genAction('exception')->init()->dispatch()->grasp($e)->tail();
			}
		} else {
			$actionGen->genAction()->init()->dispatch()->tail();
		}
    }
}

class AutoloadException extends Exception {}
?>
