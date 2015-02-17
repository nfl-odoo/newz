<?php include("account.php") ; ?>

<?php
if( $USER_ID && isset($_POST["urls"]) ){
    $urls = explode("\n", trim($_POST["urls"]) ) ;
    include("connect_db.php") ;
    foreach( $urls as $url ){
        $query = "INSERT INTO newz(url, create_uid, dt_creation) VALUES('$url', $USER_ID, NOW()) ;" ;
        mysqli_query($link, $query) or die("ERROR SQL : $query") ;
    }
}
header( "Location: home.php" ) ;