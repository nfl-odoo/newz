<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>

<body>
    <?php include("../menu.php") ?>

    <form action="check_login.php" method="POST">
      Login : <input type="text" name="login"/><br/>
      Password : <input type="text" name="password"/><br/>
      <input type="submit" value="SEND"/><br/>
      <?php if(isset($_GET["error"])) echo $_GET["error"] ?>
    </form>
</body>
</html>