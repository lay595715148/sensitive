<?php
/**
 * 基础数据模型
 * @see https://github.com/lay595715148/sensitive
 * 
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * <p>基础数据模型</p>
 * <p>核心类，继承至此类的对象将会拥有setter和getter方法和build方法</p>
 * 
 * @abstract
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
    /**
     * 构造方法
     * @param array $properties
     */
    public function __construct($properties = array()) {
        if(is_array($properties)) {
            $this->properties = $properties;
        }
    }
    /**
     * isset property
     * @param string $name
     * @return bool
     */
    public function __isset($name) {
        return isset($this->properties[$name]);
    }
    /**
     * unset property
     * @param string $name
     * @return void
     */
    public function __unset($name) {
        unset($this->properties[$name]);
    }
    /**
     * magic setter,set value to class property
     * 
     * @see AbstractBase::__set()
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
            if($value != null) $properties[$name] = $value;
        } else if (array_key_exists($propertyAliasName, $aliases)) {
            if($value != null) $properties[$aliases[$propertyAliasName]] = $value;
        } else {
            throw new PropertyNotFoundException('There is no property:'.$name.' in class:'.get_class($this));
        }
    }
    /**
     * magic setter,get value of class property
     * 
     * @see AbstractBase::__get()
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
     * @see AbstractBase::__call()
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
                $this->$k = is_string($scope[$k])?trim($scope[$k]):$scope[$k];//is_numeric($v)?(0 + $scope[$k])://类型判断去除
            }
        }
        return $this;
    }
}

/**
 * Bean Scope Exception
 * @author liaiyong
 * @abstract
 */
class BeanScopeException extends Exception {}
?>
