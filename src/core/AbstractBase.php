<?php
abstract class AbstractBase {
    public function __call($method, $arguments) {
        if(!method_exists($this,$method)) {
			throw new MethodNotFoundException('There is no object method:'.$method.'( ) in class:'.get_class($this));
        }
    }
    public static function __callStatic($method, $arguments) {
        if(!method_exists($this,$method)) {
			throw new StaticMethodNotFoundException('There is no static method:'.$method.'( ) in class:'.get_class($this));
        }
    }
    /**
     * magic setter
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value) {
        if(!property_exists($this,$name)) {
            throw new PropertyNotFoundException('<br/>There is no property:'.$name.' in class:'.get_class($this));
        }
    }
    /**
     * magic getter
     * 
     * @param string $name
     * @return void
     */
    public function __get($name) {
        if(!property_exists($this,$name)) {
            throw new PropertyNotFoundException('<br/>There is no property:'.$name.' in class:'.get_class($this));
        }
    }
}
class PropertyNotFoundException extends Exception {}
class MethodNotFoundException extends Exception {}
class StaticMethodNotFoundException extends Exception {}
?>
