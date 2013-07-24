<?php
/**
 * 数据库增删改查等基本操作接口
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 数据库增删改查等基本操作接口
 * @interface
 */
interface Interface_DBPerform {
	/**
	 * 打开mysql数据库连接
	 */
    public function open();
	/**
	 * 关闭mysql数据库连接
	 * @return bool
	 */
    public function close();
    /**
     * mysql执行sql语句
     * @param string $sql
     * @param string $encoding
     * @param bool $showSQL
     * @return mixed
     */
    public function query($sql, $encoding = '', $showSQL = false);
    /**
     * mysql执行insert语句
     * @param string $table 表名
     * @param array|string $fields 表字段数组
     * @param array|string $values 表字段对应值数组
     * @param bool $replace
     * @param bool $returnid
     * @return int|bool
     */
    public function insert($table, $fields = '', $values = '', $replace = false, $returnid = true);
    /**
     * mysql执行delete语句
     * @param string $table 表名
     * @param array|string|Condition $condition 条件
     * @return bool
     */
    public function delete($table, $condition = '');
    /**
     * mysql执行update语句
     * @param string $table 表名
     * @param array|string $fields 表字段数组
     * @param array|string $values 表字段对应值数组
     * @param array|string|Condition $condition 条件
     * @return bool
     */
    public function update($table, $fields = '', $values = '', $condition = '');
    /**
     * mysql执行select语句
     * @param string $table 表名
     * @param array|string $fields 表字段数组
     * @param array|string|Condition $condition 条件
     * @param array|string $group 
     * @param array|string|Arrange $order
     * @param string $limit 
     * @return mixed
     */
    public function select($table, $fields = '', $condition = '', $group = '', $order = '', $limit = '');
    /**
     * mysql执行记数语句
     * @param string $table 表名
     * @param array|string|Condition $condition 条件
     * @param array|string $group 
     * @return bool
     */
    public function count($table, $condition = '', $group = '');
    /**
     * 转换为insert语句
     * @param string $table 表名
     * @param array|string $fields 表字段数组
     * @param array|string $values 表字段对应值数组
     * @param bool $replace
     * @return string
     */
    public function insertSQL($table, $fields = '', $values = '', $replace = false);
    /**
     * 转换为delete语句
     * @param string $table 表名
     * @param array|string|Condition $condition 条件
     * @return string
     */
    public function deleteSQL($table, $condition = '');
    /**
     * 转换为update语句
     * @param string $table 表名
     * @param array|string $fields 表字段数组
     * @param array|string $values 表字段对应值数组
     * @param array|string|Condition $condition 条件
     * @return string
     */
    public function updateSQL($table, $fields = '', $values = '', $condition = '');
    /**
     * 转换为select语句
     * @param string $table 表名
     * @param array|string $fields 表字段数组
     * @param array|string|Condition $condition 条件
     * @param array|string $group 
     * @param array|string|Arrange $order
     * @param string $limit 
     * @return string
     */
	public function selectSQL($table, $fields = '', $condition = '', $group = '', $order = '', $limit = '');
    /**
     * 转换为记数语句
     * @param string $table 表名
     * @param array|string|Condition $condition 条件
     * @param array|string $group 
     * @return string
     */
    public function countSQL($table, $condition = '', $group = '');
	/**
	 * 将结果集转换为指定数量的数组
	 * @param int $count
	 * @param mixed $result
	 * @return array
	 */
    public function toArray($count = 0, $result = '');
	/**
	 * 获取结果集
	 * @return mixed
	 */
    public function toResult();
	/**
	 * 获取结果集中的行数或执行影响的行数
	 * @param mixed $result
	 * @param bool $isselect
	 * @return mixed
	 */
    public function toCount($result = '', $isselect = true);
}
?>
