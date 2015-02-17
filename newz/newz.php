<?php include("account.php") ?>

<htlm> <head>
    <title> Newz - Newz </title>
    <link href="newz.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>

<body>
<?php include("index.php") ?>

    <div id="main">
        NEWS !<br/>
<?php include("connect_db.php") ;
$query = "SELECT * FROM newz ;" ;
$result = mysqli_query($link, $query) or die("ERROR SQL : $query") ;
while( $data = mysqli_fetch_assoc($result) ){
    $url = $data["url"] ?>
    <a href=<?php echo $url ?>><?php echo $url ?></a> <br/>
<?php } ?>
    </div>

</body> </html>