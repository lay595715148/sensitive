<?php
if(!defined('INIT_SENSITIVE')) { exit; }

final class Mysql extends AbstractStore implements Interface_DBPerform {
    private $link;
    private $result;
    public function init() {
        $this->open();
        return $this;
    }
    public function open() {
        $config = &$this->config;
        $link   = &$this->link;

        $host = $config['host'];
        $name = $config['username'];
        $password = $config['password'];
        $database = $config['database'];

        if($link = @mysql_connect($host, $name, $password)) {
            if($database && !@mysql_select_db($database, $link)) {
                throw new MysqlException('Cannot select mysql database:'.$database.'!');
            }
        } else {
            throw new MysqlException('Cannot connect to mysql server:'.$host.'!');
        }
	}
    /**
     * @return boolean
     */
    public function close() {
        $link = &$this->link;
        return @mysql_close($link);
    }
    public function query($sql, $encoding = '', $showSQL = false) {
        $config = &$this->config;
        $result = &$this->result;
        $link   = &$this->link;
        if(!$link) { return false; }
        
        if($encoding) {
            mysql_query('SET NAMES '.$encoding,$link);
        } else if($config['encoding']) {
            $encoding = &$config['encoding'];
            mysql_query('SET NAMES '.$encoding,$link);
        }
        if($showSQL) {
            echo '<pre>'.$sql.'</pre>';
        } else if($config['showsql']) {
            $encoding = &$config['showsql'];
            echo '<pre>'.$sql.'</pre>';
        }
        if($sql) {
            $result = mysql_query($sql,$link);
        }

        return $result;
    }
    public function insert($table, $fields = '', $values = '', $replace = false, $returnid = true) {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }

        $sql = $this->insertSQL($table, $fields, $values, $replace);
        $result = $this->query($sql);

        return ($returnid)?mysql_insert_id($link):$result;
    }
    public function delete($table, $condition = '') {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }

        $sql = $this->deleteSQL($table, $condition);
        $result = $this->query($sql);

        return $result;
    }
    public function update($table, $fields = '', $values = '', $condition = '') {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }

        $sql = $this->updateSQL($table, $fields, $values, $condition);
        $result = $this->query($sql);

        return $result;
    }
    public function select($table, $fields = '', $condition = '', $group = '', $order = '', $limit = '') {//$group is not useful
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }
        
        $sql = $this->selectSQL($table, $fields, $condition, $group, $order, $limit);
        $result = $this->query($sql);

        return $result;
    }
    /* count */
    public function count($table, $condition = '', $group = '') {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }
        
        $sql = $this->countSQL($table, $condition, $group);
        $result = $this->query($sql);
        
		return $result;
	}
    public function insertSQL($table, $fields = '', $values = '', $replace = false) {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }

        if(is_array($values)) {
            $values = $this->array2Value($fields,$values,$table);
        } else if(!is_string($values)) {
            return false;
        }
        if(is_array($fields)) {
            $fields = $this->array2Field($fields,$table);
        } else if(!is_string($fields)) {
            return false;
        }
        
        $sql    = (($replace)?'REPLACE':'INSERT')." INTO $table ( $fields ) VALUES ( $values )";
        return $sql;
	}
    public function deleteSQL($table, $condition = '') {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }

        if(is_array($condition)) {
            $condition = $this->array2Where($condition,$table);
        } else if(is_a($condition,'Condition')) {
            $condition = $this->condition2Where($condition,$table);
        } else if(!is_string($condition)) {
            return false;
        }
        
        $sql    = "DELETE FROM $table $condition";
        return $sql;
	}
    public function updateSQL($table, $fields = '', $values = '', $condition = '') {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }

        if(is_array($values) && is_array($fields)) {
            $values = $this->array2Setter($fields,$values,$table);
        } else if(is_array($values)){
            $values = $this->array2Setter('',$values,$table);
        } else if(!is_string($values)) {
            return false;
        }
        if(is_array($condition)) {
            $condition = $this->array2Where($condition,$table);
        } else if(is_a($condition,'Condition')) {
            $condition = $this->condition2Where($condition,$table);
        } else if(!is_string($condition)) {
            return false;
        }
        
        $sql    = "UPDATE $table SET $values $condition";
        return $sql;
	}
	public function selectSQL($table, $fields = '', $condition = '', $group = '', $order = '', $limit = '') {//$group is not useful
        if(!is_string($table) || !$table) { return false; }

        if(is_array($fields)) {
            $fields = $this->array2Field($fields,$table);
        } else if($fields && !is_string($fields)) {
            return false;
		} else if(is_string($fields) && trim($fields)) {
			//
        } else {
            $fields = '*';
        }
        if(is_array($condition)) {
            $condition = $this->array2Where($condition,$table);
        } else if(is_a($condition,'Condition')) {
            $condition = $this->condition2Where($condition,$table);
        } else if(!is_string($condition)) {
            return false;
        }
        if(!is_string($group)) {
            $group = "";
        }
        if(is_a($order,'Arrange')) {
            $order = $this->arrange2Order($order,$table);
        } else if(is_array($order)) {
            $order = $this->array2Order($order,$table);
        } else if(!is_string($order)) {
            $order = "";
        }
        if(!is_string($limit)) {
            $limit = "";
        }

        $sql    = "SELECT $fields FROM $table $condition $group $order $limit";
        return $sql;
	}
	public function countSQL($table, $condition = '', $group = '') {
        $result = &$this->result;
        $link   = &$this->link;
        if(!is_string($table) || !$table || !$link) { return false; }
        
        if(is_array($condition)) {
            $condition = $this->array2Where($condition,$table);
        } else if(is_a($condition,'Condition')) {
            $condition = $this->condition2Where($condition,$table);
        } else if(!is_string($condition)) {
            return false;
        }
        if(!is_string($group)) {
            $group = "";
        }
        
        $sql    = "SELECT count(*) as count FROM $table $condition $group";
        return $sql;
	}
    public function toArray($count = 0, $result = '') {
        $rows = array();
        $result = ($result)?$result:$this->result;
        if(!$result) {
			
        } else if($count == 1) {
            $rows = mysql_fetch_array($result,MYSQL_ASSOC);
        } else if($count != 0) {
            $i = 0;
            if(@mysql_num_rows($result)) {
                while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
                    if($i<$count) {
                        $rows[$i] = (array)$row;
                        $i++;
                    } else {
                        break;
                    }
                }
            }
        } else {
            $i = 0;
            if(@mysql_num_rows($result)) {
                while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
                    $rows[$i] = (array)$row;
                    $i++;
                }
            }
        }
        
        return $rows;
    }
    public function toResult() {
        return $this->result;
    }
    public function toCount($result = '', $isselect = true) {
        if(!$result) { $result = &$this->result; }
        if($isselect) {
            return mysql_num_rows($result);
        } else {
            return mysql_affected_rows($this->link);
        }
    }

    /**
     * get the class name by table name from the class-table-mapping
     * @param string $table
     * @return string
     */
    private function getClassByTable($table) {
        global $_CFG;
        $tables    = &$_CFG['mapping']['tables'];
        $className = array_search($table,$tables);
        $className = (is_array($className))?$className[0]:$className;
        return $className;
    }
    /**
     * get field SQL by an array and table name from the class-table-field-mapping
     * @param array $arr
     * @param string $table
     * @return string
     */
    private function array2Field($arr,$table) {
        global $_CFG;
        $str       = '';
        $count     = 0;
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];

        foreach($arr as $v) {
            if(array_search($v,$mapping) && $count > 0) {
                $str .= ",`$v`";
                $count++;
            } else if(array_search($v,$mapping) && $count == 0) {
                $str .= "`$v`";
                $count++;
            } else if(array_key_exists($v,$mapping) && $count > 0) {
                $str .= ",`".$mapping[$v]."`";
                $count++;
            } else if(array_key_exists($v,$mapping) && $count == 0) {
                $str .= "`".$mapping[$v]."`";
                $count++;
            }
        }

        return $str;
    }
    /**
     * get value SQL by a field array,a value array and table name from the class-table-field-mapping
     * @param array $fields
     * @param array $values
     * @param string $table
     * @return string
     */
    private function array2Value($fields,$values,$table) {
        global $_CFG;
        $str       = '';
        $count     = 0;
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];

        if(is_array($fields) && is_array($values)) {
            foreach($fields as $k) {
                $v = $values[$k];
                $v = mysql_real_escape_string($v,$this->link);
                if((array_search($k,$mapping) || array_key_exists($k,$mapping)) && $count > 0) {
                    $str .= ",'$v'";
                    $count++;
                } else if((array_search($k,$mapping) || array_key_exists($k,$mapping)) && $count == 0){
                    $str .= "'$v'";
                    $count++;
                }
            }
        }

        return $str;
    }
    /**
     * get setter SQL by a field array,a value array and table name from the class-table-field-mapping
     * @param array $fields
     * @param array $values
     * @param array $table
     * @return string
     */
    private function array2Setter($fields,$values,$table) {
        global $_CFG;
        $str       = '';
        $count     = 0;
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];
    
        if($fields && is_array($fields)) {
            foreach($fields as $k) {
                $v = $values[$k];
                $v = mysql_real_escape_string($v,$this->link);
                if(array_search($k,$mapping) && $count > 0) {
                    $str .= ",`$k` = '$v'";
                    $count++;
                } else if(array_search($k,$mapping) && $count == 0){
                    $str .= "`$k` = '$v'";
                    $count++;
                } else if(array_key_exists($k,$mapping) && $count > 0) {
                    $str .= ",`".$mapping[$k]."` = '$v'";
                    $count++;
                } else if(array_key_exists($k,$mapping) && $count == 0){
                    $str .= "`".$mapping[$k]."` = '$v'";
                    $count++;
                }
            }
        } else {
            foreach($values as $k=>$v) {
                $v = mysql_real_escape_string($v,$this->link);
                if(!is_numeric($k) && array_search($k,$mapping) && $count > 0) {
                    $str .= ",`$k` = '$v'";
                    $count++;
                } else if(!is_numeric($k) && array_search($k,$mapping) && $count == 0){
                    $str .= "`$k` = '$v'";
                    $count++;
                } else if(!is_numeric($k) && array_key_exists($k,$mapping) && $count > 0) {
                    $str .= ",`".$mapping[$k]."` = '$v'";
                    $count++;
                } else if(!is_numeric($k) && array_key_exists($k,$mapping) && $count == 0){
                    $str .= "`".$mapping[$k]."` = '$v'";
                    $count++;
                }
            }
        }

        return $str;
    }
    /**
     * get where SQL by an array and table name from the class-table-field-mapping
     * @param array $arr
     * @param string $table
     * @return string
     */
    private function array2Where($arr,$table) {
        global $_CFG;
        $str       = '';
        $count     = 0;
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];

        foreach($arr as $k=>$v) {
            if(is_a($v,'Condition') && $count > 0) {
                $str .= ' AND ('.substr($this->condition2Where($v, $table),6).')';
                $count++;
                continue;
            } else if(is_a($v,'Condition') && $count == 0){
                $str .= '('.substr($this->condition2Where($v, $table),6).')';
                $count++;
                continue;
            }
            $v = mysql_real_escape_string($v,$this->link);
            if(!is_numeric($k) && array_search($k,$mapping) && $count > 0) {
                $str .= " AND `$k` = '$v'";
                $count++;
            } else if(!is_numeric($k) && array_search($k,$mapping) && $count == 0){
                $str .= "`$k` = '$v'";
                $count++;
            } else if(!is_numeric($k) && array_key_exists($k,$mapping) && $count > 0){
                $str .= " AND `".$mapping[$k]."` = '$v'";
                $count++;
            } else if(!is_numeric($k) && array_key_exists($k,$mapping) && $count == 0) {
                $str .= "`".$mapping[$k]."` = '$v'";
                $count++;
            }
        }

        return ($str)?"WHERE $str":"WHERE 0";
    }
    /**
     * analyze an instance of Condition to where sql part
     * @param Condition $obj
     * @param string $table
     * @return string
     */
    private function condition2Where($obj, $table) {
        global $_CFG;
        $str       = '';
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];
        $orpos     = $obj->getOrpos();
        $conds     = $obj->getConds();//clone

        foreach($conds as $k=>$cell) {
            $field = $cell->getName();
            $value = $cell->getValue();
            if(is_array($value)) {
                foreach($value as $_k=>$v) {
                    $value[$_k] = mysql_real_escape_string($v);
                }
            } else {
                $value = mysql_real_escape_string($value);
            }
            $cell->setValue($value);

            if($str === '' && array_search($field,$mapping)) {
                $str .= $cell->toSQLString();
            } else if($str === '' && array_key_exists($field,$mapping)) {
                $cell->setName($mapping[$field]);
                $str .= $cell->toSQLString();
            } else if(array_search($field,$mapping)) {
                $str .= ( $orpos === true || is_numeric($orpos) && $k >= $orpos )?' OR ':' AND ';
                $str .= $cell->toSQLString();
            } else if(array_key_exists($field,$mapping)) {
                $cell->setName($mapping[$field]);
                $str .= ( $orpos === true || is_numeric($orpos) && $k >= $orpos )?' OR ':' AND ';
                $str .= $cell->toSQLString();
            }
        }
        return ($str)?"WHERE $str":"WHERE 0";
    }
    /**
     * array('my_field'=>'DESC','your_field'=>'ASC')
     * array('my_field'=>1,'your_field'=>0)
     */
    private function array2Order($arr, $table) {
        global $_CFG;
        $str       = '';
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];
        foreach($arr as $k=>$or) {
            if(is_numeric($k)) {
                $field = $or;
                $desc  = false;
            } else if(is_string($k)){
                $field = $k;
                $desc  = ($or == 'DESC' || $or)?true:false;
            }
            if($str === '' && array_search($field,$mapping)) {
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            } else if($str === '' && array_key_exists($field,$mapping)) {
                $field = $mapping[$field];
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            } else if(array_search($field,$mapping)) {
                $str  .= ', ';
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            } else if(array_key_exists($field,$mapping)) {
                $field = $mapping[$field];
                $str  .= ', ';
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            }
        }
        return ($str)?"ORDER BY $str":"";
    }
    /**
     * analyze an instance of Arrange to order sql part
     * @param Arrange $obj
     * @param string $table
     * @return string
     */
    private function arrange2Order($obj, $table) {
        global $_CFG;
        $str       = '';
        $className = $this->getClassByTable($table);
        $mapping   = &$_CFG['mapping'][$className];
        $order     = $obj->getOrder();

        foreach($order as $k=>$ord) {
            $field = $ord['field'];
            $desc  = $ord['desc'];
            if($str === '' && array_search($field,$mapping)) {
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            } else if($str === '' && array_key_exists($field,$mapping)) {
                $field = $mapping[$field];
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            } else if(array_search($field,$mapping)) {
                $str  .= ', ';
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            } else if(array_key_exists($field,$mapping)) {
                $field = $mapping[$field];
                $str  .= ', ';
                $str  .= '`'.$field.(($desc)?'` DESC ':'` ASC ');
            }
        }
        return ($str)?"ORDER BY $str":"";
    }
}

class MysqlException extends Exception {}
?>
