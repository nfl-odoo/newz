<?php

if( isset( $_POST["login"] ) && isset( $_POST["password"] ) && isset( $_POST["name"] ) ) {
    $login = $_POST["login"] ;
    $password = $_POST["password"] ;
    $name = $_POST["name"] ;

    include("connect_db.php") ;
    $query = "SELECT * FROM users WHERE name = '$name' ;" ;
    $result = mysqli_query( $link, $query ) ;
    if( $data = mysqli_fetch_assoc($result) ) {
        header( "Location: register.php?error=name '$name' is already an used name" ) ;
    } else {
        $query = "SELECT * FROM users WHERE login = '$login' ;" ;
        $result = mysqli_query( $link, $query ) ;
        if( $data = mysqli_fetch_assoc($result) ){
            header( "Location: register.php?error='$login' is already an used login" ) ;
        } else {
            $query = "INSERT INTO users(name, login, password, dt_creation, dt_last_connect) VALUES('$name', '$login', '$password', NOW(), FALSE ) ;" ;
            mysqli_query( $link, $query ) or die("ERROR SQL : $query") ;
            header( "Location: log_in.php?error=You can now log in" ) ;
        }
    }
} else {
    header( "Location: home.php?error=Pleeeeease" ) ;
}

?>