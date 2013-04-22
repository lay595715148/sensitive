<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class Paging extends AbstractBean {

    public function __construct(&$properties = '') {
        $this->properties = array(
            'page' => 0,//当前页码,默认为1,第1页即为1,尾页为-1
            'pageSize' => 0,//一页内记录数,默认为20,不分页为-1
            'pageCount' => 0,//页数
            'count' => 0,//总记录数
            'text' => '',//总记录数
            'href' => 0//指向页
        );
    }

    /**
     * 自动注入Bean,默认从$_REQUEST中读取数据
     * 
     * @return Bean
     */
    public function build($scope = 0) {
        if(is_numeric($scope)) {
            $scope = &Scope::parseScope($scope);
        } else if(!is_array($scope)){
            throw new BeanScopeException('There is a type error in class:'.get_class($this).' method:build( ) param:$scope');
            return;
        }
        foreach($this->toArray() as $k=>$v) {
            if(array_key_exists($k, $scope)) {
                $this->$k = ($k == 'text')?$scope[$k]:(int)$scope[$k];
            }
        }
        return $this;
    }

    /**
     * 运算分页数
     */
    public function carry() {
        $page      = $this->getPage();
        $pageSize  = $this->getPageSize();
        $pageCount = $this->getPageCount();
        $count     = $this->getCount();
        
        if($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 10;
        if($pageSize > 0) {
            $pageCount = (int)floor(($count + $pageSize - 1)/$pageSize);
        }
        if($page == -1 || $page > $pageCount) {
            $page = $pageCount;
        }

        $this->setPage($page);
        $this->setPageSize($pageSize);
        $this->setPageCount($pageCount);
        $this->setCount($count);
        return $this;
    }
    public function toPaging() {
        if($this->getPageSize() == -1) return;
        $pages = $this->toPages();
        $page  = $this->toArray();
        return array('page'=>$page,'pages'=>$pages);
    }

    /**
     * 返回当前页前后各 $count 的页码罗列排序后的数组
     */
    public function toPages($count = 5) {
        $page      = $this->getPage();
        $pageCount = $this->getPageCount();
        $paging    = $this->toArray();
        $morePre   = true;
        $moreNext  = true;

        $pages[$page] = array_merge($paging,array('href'=>$page,'text'=>$page));
        for($i = $count;$i > 0;$i--) {
            $pre  = $page - $i;
            $next = $page + $i;
            if($pre > 0) {
                $pages[$pre]  = array_merge($paging,array('href'=>$pre,'text'=>$pre));
                if($pre == 1) $morePre = false;
            } else {
                $morePre = false;
            }
            if($next <= $pageCount) {
                $pages[$next] = array_merge($paging,array('href'=>$next,'text'=>$next));
                if($next == $pageCount) $moreNext = false;
            } else {
                $moreNext = false;
            }
        }
        if(count($pages) > 1) ksort($pages);
        if($morePre) {
            $morep = $page - $count - $count;
            array_unshift( $pages,array_merge( $paging,array('href'=>($morep > 0)?$morep:1,'text'=>'...') ) );
        }
        if($moreNext) {
            $moren = $page + $count + $count;
            array_push( $pages,array_merge( $paging,array('href'=>($moren <= $pageCount)?$moren:$pageCount,'text'=>'...') ) );
        }
        if($page - 1 >= 1) array_unshift( $pages,array_merge( $paging,array('href'=>$page - 1,'text'=>'上一页') ) );
        if($page + 1 <= $pageCount) array_push( $pages,array_merge( $paging,array('href'=>$page + 1,'text'=>'下一页') ) );
        if($page != 1) {
            array_unshift( $pages,array_merge( $paging,array('href'=>1,'text'=>'首页') ) );
        } else {
            array_unshift( $pages,array_merge( $paging,array('href'=>1,'text'=>'首页') ) );
            array_shift( $pages );
        }
        if($page != $pageCount) {
            array_push( $pages,array_merge( $paging,array('href'=>$pageCount,'text'=>'尾页') ) );
        }
        return $pages;
    }
    /**
     * 转换为 SQL LIMIT 部分
     */
    public function toLimit() {
        $pageSize = $this->getPageSize();
        if($pageSize && $pageSize > 0) {
            $return    = $this->carry();
            $page      = $this->getPage();
            $pageCount = $this->getPageCount();
            $count     = $this->getCount();
            if($page && $page == 1) 
                $limit = 'LIMIT '.($page*$pageSize);
            else if($page && $page > 1)
                $limit = 'LIMIT '.(($page-1)*$pageSize).','.$pageSize;
            else if($page && $page == -1)
                $limit = 'LIMIT '.(($pageCount-1)*$pageSize).','.$pageSize;
        }
        return $limit;
    }
}
?>
