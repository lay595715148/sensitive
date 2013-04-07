<?php
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
        if($_CFG['routes-start'] && array_key_exists('routes',$_CFG) && $_CFG['routes']) {
			//hasn't been implemented
			$router = new Router();
			foreach($_CFG['routes'] as $index=>$route) {
				// defining routes 
				$router->map($route['pattern'], '', $route['args']);
			}

			// match current request URL & http method
			$matchs = $router->matchCurrentRequest();
			echo "<pre>";print_r($matchs);echo "</pre>";
		} else {
			$actionGen = new DefaultActionGen();
			$action    = $actionGen->genAction()->init()->dispatch();
		}
    }
}

class AutoloadException extends Exception {}
?>
