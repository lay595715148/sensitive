<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class TableBean extends AbstractBean {
	public function toTable() {
		global $_CFG;
        $className = get_class($this);
        $tables    = &$_CFG['mapping']['tables'];
        if(!array_key_exists($className,$_CFG['mapping']['tables'])) throw new TableMappingException('There\'s no table mapping in $_CFG[\'mapping\'][\'tables\']');
        return $tables[$className];
    }
    public function toField($property) {
		global $_CFG;
        $className = get_class($this);
        if(!array_key_exists($className,$_CFG['mapping'])) throw new TableMappingException('There\'s no table fields mapping in $_CFG[\'mapping\']');
        $mapping   = &$_CFG['mapping'][$className];
        $field     = ($mapping && array_key_exists($property,$mapping))?$mapping[$property]:$property;
        return $field;
    }
    public function toFields() {
		global $_CFG;
        $className = get_class($this);
        if(!array_key_exists($className,$_CFG['mapping'])) throw new TableMappingException('There\'s no table fields mapping in $_CFG[\'mapping\']');
        $mapping   = &$_CFG['mapping'][$className];
        $fields    = array();
        if($mapping) {
            foreach($this->toArray() as $k=>$v) {
                $name     = $k;
                $fields[] = array_key_exists($name,$mapping)?$mapping[$name]:$name;
            }
			return $fields;
        } else {
			return;
		}
    }
    public function toInsertFields() {
		global $_CFG;
        $className = get_class($this);
        if(!array_key_exists($className,$_CFG['mapping'])) throw new TableMappingException('There\'s no table fields mapping in $_CFG[\'mapping\']');
        $mapping   = &$_CFG['mapping'][$className];
        $fields    = array();
        if($mapping) {
            foreach($this->toArray() as $k=>$v) {
                if($k === 'id') continue;
                $name     = $k;
                $fields[] = array_key_exists($name,$mapping)?$mapping[$name]:$name;
            }
			return $fields;
        } else {
			return;
		}
	}
    public function toValues() {
		global $_CFG;
        $className = get_class($this);
        if(!array_key_exists($className,$_CFG['mapping'])) throw new TableMappingException('There\'s no table fields mapping in $_CFG[\'mapping\']');
        $mapping   = &$_CFG['mapping'][$className];
        $values    = array();
        if($mapping) {
            foreach($this->toArray() as $k=>$v) {
                $name           = $k;
                $field          = array_key_exists($name,$mapping)?$mapping[$name]:$name;
                $values[$field] = $v;
            }
			return $values;
        } else {
			return;
		}
    }
    public function rowsToEntities($rows) {
        $entities  = array();
        $className = get_class($this);
        if(is_array($rows) && !empty($rows)) {
            foreach($rows as $k=>$row) {
                if(is_array($row) && class_exists($className)) {
                    $bean       = new $className();
                    $return     = $bean->rowToEntity($row);
                    $entities[] = $bean;
                }
            }
			return $entities;
        } else {
			return;
		}
    }
    public function rowToEntity($row) {
		global $_CFG;
        $className = get_class($this);
        $mapping   = &$_CFG['mapping'][$className];
        if(!array_key_exists($className,$_CFG['mapping'])) throw new TableMappingException('There\'s no table fields mapping in $_CFG[\'mapping\']');
        if(is_array($row) && $mapping) {
            foreach($this->toArray() as $k=>$v) {
                    $name     = $k;
                    $key      = array_key_exists($name,$mapping)?$mapping[$name]:$name;
                    $this->$k = array_key_exists($key,$row)?$row[$key]:'';
            }
			return $this;
        } else {
			return;
		}
    }
    public function rowsToArray($rows) {
        $arrs      = array();
        $className = get_class($this);
        if(is_array($rows)) {
            foreach($rows as $k=>$row) {
                if(is_array($row) && class_exists($className)) {
                    $bean   = new $className();
                    $arr    = $bean->rowToArray($row);
                    $arrs[] = $arr;
                }
            }
			return $arrs;
        } else {
			return;
		}
    }
    public function rowToArray($row) {
        $arr = array();
        if(is_array($row)) {
            $bean = $this->rowToEntity($row);
            $arr  = $bean->toArray();
			return $arr;
        } else {
			return;
		}
    }
}
class TableMappingException extends Exception {}
?>
