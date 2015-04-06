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
        div.top_menu{
            height: 8px;
        }
        div{
            word-wrap: break-word;
            width: calc(100% - 8px);
            position: relative;
            margin: 4px;
        }
        div.newz{
            border-radius: 4px;
        }
        div.newz:after {
            border-radius: 4px;
            content : "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            background-image: url("images/science.png");
            background-repeat: no-repeat;
            background-size: 100%;
            width: 100%;
            height: 100%;
            opacity : 0.5;
            z-index: -1;
            word-wrap: break-word;
        }

        div.short{
            visibility: visible;
            position: relative;
        }
        div.long{
            visibility: hidden;
            position: absolute;
        }
    </style>
    <script>
    function swap_long_short(elem){
        var newzs = document.getElementsByClassName("newz") ;
        for(var i = 0 ; i < newzs.length ; i++){
            scs = newzs[i].getElementsByClassName("short")[0].style ;
            lcs = newzs[i].getElementsByClassName("long")[0].style ;

            if(newzs[i] == elem){
                if(scs.visibility == "hidden"){
                    scs.visibility = "visible" ;
                    scs.position = "relative" ;
                    lcs.visibility = "hidden" ;
                    lcs.position = "absolute" ;
                } else {
                    lcs.visibility = "visible" ;
                    lcs.position = "relative" ;
                    scs.visibility = "hidden" ;
                    scs.position = "absolute" ;
                }
            } else {
                scs.visibility = "visible" ;
                scs.position = "relative" ;
                lcs.visibility = "hidden" ;
                lcs.position = "absolute" ;
            }
        }
    }
    </script>
</head>

<body>
    <?php include("menu.php") ?>

    <div class="main_ulock">
        <div class="top_menu"></div>
        <?php foreach($newzs as $newz){
            $id = $newz["id"] ;
            $author = $newz["author"] ;
            $title = $newz["title"] ;
            $content = $newz["content"] ; ?>
            <div class="newz"  onclick="swap_long_short(this)">
            <?php echo "$id - $title" ?> <br/>
                <div class="short">
                <?php echo substr($content, 0, 199).(strlen($content) > 200 ? "[...]" : "") ?>
                </div>
                <div class="long">
                <?php echo $content ?>
                </div>
            </div> 
            <div></div><?php
        } ?>
    </div>
</body>
</html>
