<?php
include("account.php") ;
if( isset($control) ){
    if( $USER_RANK != $control ){
        header( "Location: home.php" ) ;
    }
} else {
    header( "Location: home.php" ) ;
}