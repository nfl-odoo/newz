<?php
session_start() ;

$UID = isset($_SESSION["uid"]) ? $_SESSION["uid"] : NULL ;
$USER_NAME = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : NULL ;
$DEFAULT_SERVER = "localhost:9000" ;
$DEFAULT_DB = "newz" ;