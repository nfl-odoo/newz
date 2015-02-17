<?php
session_start() ;
if( isset($_SESSION["user_id"]) ){
    $USER_ID = $_SESSION["user_id"] ;
    $USER_NAME = $_SESSION["user_name"] ;
    $USER_RANK = $_SESSION["user_rank"] ;
} else {
    $USER_ID = 0 ;
}
?>