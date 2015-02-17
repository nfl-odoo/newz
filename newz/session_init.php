<?php
session_start() ;
if( isset( $_POST["login"] ) && isset( $_POST["password"] ) ) {
    $login = $_POST["login"] ;
    $password = $_POST["password"] ;

    include("connect_db.php") ;
    $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password' ;" ;
    $result = mysqli_query( $link, $query ) ;

    if( $data = mysqli_fetch_assoc($result) ) { 
        $USER_ID = $data["id"] ;
        $_SESSION["user_login"] = $login ;
        $_SESSION["user_name"] = $data["name"] ;
        $_SESSION["user_rank"] = $data["rank"] ;
        $_SESSION["user_id"] = $USER_ID ;
        $query = "UPDATE users SET dt_last_connect = NOW() WHERE id = $USER_ID" ;
        mysqli_query( $link, $query ) ;
        header( "Location: home.php" ) ;
    } else {
        header( "Location: log_in.php?error=invalid login or password" ) ;
    }
} else {
    header( "Location: log_in.php?error=Pleeeeeease" ) ;
}

?>