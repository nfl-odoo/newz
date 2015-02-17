<?php include("account.php") ; ?>
<?php $error = isset( $_GET["error"] ) ? $_GET["error"] : "" ; ?>
<?php if( $USER_ID ) header("Location: ./home.php"); ?>

<htlm><head>
    <title> Newz - Registration </title>

    <link href="register.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>

<body>
    <?php include("index.php") ?>
    <div id="main">
        <form action="user_create.php" method="POST">
            Name : <input type="text" name="name"/><br/>
            Login : <input type="text" name="login"/><br/>
            Password : <input type="text" name="password"/><br/>
            <input type="submit" value="REGISTER"/><br/>
            <?php echo $error ?>
        </form>
    </div>
</body></html>