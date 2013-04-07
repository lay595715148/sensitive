<?php
class Scope {
    const SCOPE_REQUEST = 0;
    const SCOPE_GET = 1;
    const SCOPE_POST = 2;
    const SCOPE_SESSION = 3;
    const SCOPE_COOKIE = 4;
    const SCOPE_GLOBAL = 5;
    /**
     * 将scope标记量转换为变量
     * 
     * @param int $scope
     * @return mixed
     */
    public static function parseScope($scope) {
        switch($scope) {
        case self::SCOPE_REQUEST: 
            $scope = $_REQUEST;
            break;
        case self::SCOPE_GET: 
            $scope = $_GET;
            break;
        case self::SCOPE_POST: 
            $scope = $_POST;
            break;
        case self::SCOPE_SESSION: 
            $scope = $_SESSION;
            break;
        case self::SCOPE_COOKIE: 
            $scope = $_COOKIES;
            break;
        case self::SCOPE_GLOBAL: 
            $scope = $_GLOBALS;
            break;
        default :
            $scope = $_REQUEST;
            break;
        }
        return $scope;
    }
}
?>
