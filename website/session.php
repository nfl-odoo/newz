<?php
session_start() ;

function _get_session($arg){
    return isset($_SESSION[$arg]) ? $_SESSION[$arg] :  NULL ;
}

$UID = _get_session("uid") ;
$USER_NAME = _get_session("user_name") ;
$DEFAULT_LOGIN = _get_session("login") ;
$DEFAULT_PWD = _get_session("pwd") ;
$DEFAULT_SERVER = "localhost:9000" ;
$DEFAULT_DB = "newz" ;