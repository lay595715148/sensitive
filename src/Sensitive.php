<?php
/**
 * 统一入口类,
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
        echo "Sensitive works!";
        global $_CFG;
        $actionGen  = new DefaultActionGen();
        $action     = $actionGen->genAction();
        $initBoo    = $action->init();
        $dispBoo    = $action->dispatch();

        print_r(class_exists('DefaultActionGen')?'1':'0');
    }
}
?>
