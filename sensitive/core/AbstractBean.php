<?php
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 
 * @author liaiyong
 * @abstract
 *
 */
abstract class AbstractBean extends AbstractBase {
    /**
     * class properties.
     * please don't modify in all methods except for '__construct','__set','__get' and so on.
     */
    protected $properties = array();
    /**
     * alias of class properties.
     * please don't modify in all methods except for '__construct','__set','__get' and so on.
     */
    protected $aliases = array();
    public function __construct($properties = '') {
        if(is_array($properties)) {
            $this->properties = $properties;
        }
    }
    /**
     * isset property
     */
    public function __isset($name) {
        return isset($this->properties[$name]);
    }
    /**
     * unset property
     */
    public function __unset($name) {
        unset($this->properties[$name]);
    }
    /**
     * magic setter,set value to class property
     * 
     * @see Base::__set()
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value) {
		$aliases = &$this->aliases;
		$properties = &$this->properties;
        if(empty($aliases)) {
            foreach(array_keys($properties) as $key) {
                $aliases[strtolower($key)] = $key;
            }
        }
        
        $propertyAliasName = strtolower($name);
        if(array_key_exists($name, $properties)) {
			$properties[$name] = $value;
        } else if (array_key_exists($propertyAliasName, $aliases)) {
            $properties[$aliases[$propertyAliasName]] = $value;
        } else {
            throw new PropertyNotFoundException('There is no property:'.$name.' in class:'.get_class($this));
        }
    }
    /**
     * magic setter,get value of class property
     * 
     * @see Base::__get()
     * @param string $name
     * @return mixed|void
     */
    public function __get($name) {
        $aliases = &$this->aliases;
        $properties = &$this->properties;
        if(empty($aliases)) {
            foreach(array_keys($properties) as $key) {
                $aliases[strtolower($key)] = $key;
            }
        }
		
        $propertyAliasName = strtolower($name);
        if(array_key_exists($name, $properties)) {
			return $properties[$name];
        } else if (array_key_exists($propertyAliasName, $aliases)) {
            return $properties[$aliases[$propertyAliasName]];
        } else {
            throw new PropertyNotFoundException('There is no property:'.$name.' in class:'.get_class($this));
        }
    }
    /**
     * magic call method,auto call setter or getter
     * 
     * @see Base::__call()
     * @param string $method
     * @param array $arguments
     * @return mixed|void
     */
    public function __call($method, $arguments) {
        if(method_exists($this,$method)) {
            return (call_user_func_array(array($this, $method), $arguments));
        } else {
            if(strtolower(substr($method, 0, 3)) === 'get') {
                return $this->{strtolower(substr($method, 3))};
            } else if(strtolower(substr($method, 0, 3)) === 'set'){
                $this->{strtolower(substr($method, 3))} = $arguments[0];
            } else {
                throw new MethodNotFoundException('There is no method:'.$method.'( ) in class:'.get_class($this));
            }
        }
    }

    /**
     * to array value of class properties
     * 
     * @return array
     */
    public function toArray() {
        return $this->properties;
    }

    /**
     * read values from variables(super global varibles or user-defined variables) then auto inject to this.
     * default read from $_REQUEST
     * @param integer|array $scope
     * @return void|Bean
     */
    public function build($scope = 0) {
        if(is_numeric($scope) || !$scope) {
            $scope = &Scope::parseScope($scope);
        } else if(!is_array($scope)){
            throw new BeanScopeException('There is a type error in class:'.get_class($this).' method:build( ) param:$scope');
        }
        foreach($this->toArray() as $k=>$v) {
            if(array_key_exists($k, $scope)) {
                $this->$k = $scope[$k];
            }
        }
        return $this;
    }
}

class BeanScopeException extends Exception {}
?>
