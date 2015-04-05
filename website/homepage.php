<html lang="en">
<head>
    <title>Homepage</title>
</head>

<body>
    <?php include("menu.php") ?>
    <?php include("session.php") ?>

    <div class="main_ulock">
        <?php echo "USER NAME : $UID - $USER_NAME" ?>
        <br/>
        <?php echo "LOGIN/PWD : $DEFAULT_LOGIN - $DEFAULT_PWD" ?>
    </div>
</body>
</html>