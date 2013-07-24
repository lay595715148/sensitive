<?php
/**
 * Sensitive主类
 * @see https://github.com/lay595715148/sensitive
 * 
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * <p>Sensitive主类</p>
 * 
 * @author liaiyong
 */
class Sensitive extends AbstractBase {
	/**
	 * @var Sensitive 自身的一个实例对象
	 */
    private static $Instance = null;
    /**
     * 私有的构造方法
     */
    private function __construct() { }
    /**
     * 获取一个实例
     */
    public static function getInstance() {
        if(self::$Instance === null) {
            self::$Instance = new Sensitive();
        }
        return self::$Instance;
    }
    /**
     * 启动Sensitive
     */
    public static function start() {
        global $_CFG;
        $instance = Sensitive::getInstance();
		$instance->run();
    }
    /**
     * 运行Sensitive
     */
    public function run() {
        global $_CFG;
        $actionGen = new DefaultActionGen();
        if($_CFG['try-exception'] === true) {
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

/**
 * autoload exception
 * 
 */
class AutoloadException extends Exception {}
?>
