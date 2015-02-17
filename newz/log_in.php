<?php include("account.php") ; ?>
<?php $error = isset( $_GET["error"] ) ? $_GET["error"] : "" ; ?>
<?php if( $USER_ID ) header("Location: ./home.php"); ?>

<htlm><head>
  <title> Newz - LOG IN </title>
 
  <link href="log_in.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
</head>

<body>
  <?php include("index.php") ?>
  <div id="main">
    <form action="session_init.php" method="POST">
      Login : <input type="text" name="login"/><br/>
      Password : <input type="text" name="password"/><br/>
      <input type="submit" value="SEND"/><br/>
      <?php echo $error ?>
    </form>
  </div>
</body></html>