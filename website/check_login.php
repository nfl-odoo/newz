<?php
include("session.php") ;
include_once("../xmlrpc_lib/odoo.php") ;

if(isset($_POST["login"]) and isset($_POST["password"])){
    $login = $_POST["login"] ;
    $pwd = $_POST["password"] ;

    $connection = connect($login, $pwd) ;
    if(!$connection->val->me['int']){
        header( "Location: login.php?error=Combinaison Login/Password is incorrect." ) ;
    } else {
        $data = read("res.users", ["id", "name"], array(array("login", "=", $login)), $login, $pwd) ;
        $_SESSION["uid"] = $data[0]["id"] ;
        $_SESSION["user_name"] = $data[0]["name"] ;
        $_SESSION["login"] = $login ;
        $_SESSION["pwd"] = $pwd ;
        header( "Location: homepage.php") ;
    }
} else {
    header( "Location: login.php?error=Must provide both Login and Password in order to log in." ) ;
}

