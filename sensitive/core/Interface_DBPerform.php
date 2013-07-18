<?php
if(!defined('INIT_SENSITIVE')) { exit; }

interface Interface_DBPerform {
    public function open();
    public function close();
    public function query($sql, $encoding = '', $showSQL = false);
    public function insert($table, $fields = '', $values = '', $replace = false, $returnid = true);
    public function delete($table, $condition = '');
    public function update($table, $fields = '', $values = '', $condition = '');
    public function select($table, $fields = '', $condition = '', $group = '', $order = '', $limit = '');
    public function count($table, $condition = '', $group = '');
    public function insertSQL($table, $fields = '', $values = '', $replace = false);
    public function deleteSQL($table, $condition = '');
    public function updateSQL($table, $fields = '', $values = '', $condition = '');
	public function selectSQL($table, $fields = '', $condition = '', $group = '', $order = '', $limit = '');
    public function countSQL($table, $condition = '', $group = '');
    public function toArray($count = 0, $result = '');
    public function toResult();
    public function toCount($result = '', $isselect = true);
}
?>
