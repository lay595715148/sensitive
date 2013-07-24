<?php
/**
 * 专门用于搜索的数据模型
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 专门用于搜索的数据模型
 * @author liaiyong<595715148@qq.com>
 * @Version: 0.1.48 (build 130723)
 */
class Search extends AbstractBean {
    /**
     * 构造方法
     */
    public function __construct() {
        $this->properties = array(
            'query' => ''
        );
    }
    /**
     * to Condition object
     * @return Condition|bool
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
