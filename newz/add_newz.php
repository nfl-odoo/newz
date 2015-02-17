<?php include("account.php") ?>
<?php $control = "admin" ; include("access_control.php") ?>

<htlm> <head>
    <title> Newz - Home </title>
    <link href="add_newz.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>

<body>
<?php include("index.php") ?>

    <div id="main">
        To add newz, copy the url in the textarea below.
        Make sure you have one link per line (separtor : LF).
        <form action="newz_create.php" method="POST">
            <textarea cols="50" row="10" name="urls">
                Urls goes here !
            </textarea><br/>
            <input type="submit" value="SEND"/>
        </form>
    </div>

</body> </html>