<?php include("account.php") ?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<htlm> <head>
    <title> LIRE TEST - Home </title>
    <link href="home.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>

<body>
<?php include("index.php") ?>

    <div id="main">
            TEST DE LECTURE<br/>
            <?php
                $page = file_get_contents("http://www.slate.fr/story/96859/football-mercato-hiver") ;
                echo explode("article_author", $page)[0] ;
                //$out_file = fopen("test.txt", "w+") ;
                //fwrite($out_file, $page) ;
                //echo $tmp = explode("<description>", $page)[0] ;
                //echo $title = explode("</description>", explode("<description>", $page)[2])[0] ;
            ?>
    </div>

</body> </html>