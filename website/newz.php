<?php include_once("../xmlrpc_lib/odoo.php") ?>
<?php include("session.php") ?>

<?php
    $model = "newz.newz" ;
    $fields = array("id", "title", "content", "author") ;
    $newzs = read($model, $fields) ;
    // print_r($newzs) ;
?>

<html lang="en">
<head>
    <title>Newz</title>
    <style>
        div.newz{
            background-color: #C1C1CB;
            word-wrap: break-word;
            width: calc(100% - 8px);
            /*height: 20%;*/
            margin: 4px;
        }
    </style>
</head>

<body>
    <?php include("menu.php") ?>

    <div class="main_ulock">
        <?php foreach($newzs as $newz){
            $id = $newz["id"] ;
            $author = $newz["author"] ;
            $title = $newz["title"] ;
            $content = $newz["content"] ; ?>
            <div class="newz">
            <?php echo "$id - $title" ?> <br/>
            <?php echo substr($content, 0, 199) ?>
            </div> <?php
        } ?>
    </div>
</body>
</html>