<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class Search extends AbstractBean {
    public function __construct() {
        $this->properties = array(
            'query' => ''
        );
    }
    /**
     * to Condition object
     */
    public function toCondtion() {
        $query = $this->getQuery();
        if($query) {
            $cond  = new Condtion();
            $cell  = Cell::parseFilterString($query);
            $index = $cond->putCell($cell);
            return $cond;
        } else {
            return false;
        }
    }
}
?>
