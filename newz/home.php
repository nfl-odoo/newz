<?php include("account.php") ?>

<htlm> <head>
    <title> Newz - Home </title>
    <link href="home.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>

<body>
<?php include("index.php") ?>

    <div id="main">
        My_Home <br/>
        Welcome <?php if($USER_ID) echo $USER_NAME ?> <br/>
    </div>

</body> </html>