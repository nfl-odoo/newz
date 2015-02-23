<meta charset="UTF-8">
<?php include("account.php") ; ?>

<?php
function jdg($xpath, $page){
    $res = [] ;
    $res["title"] = $xpath->query("//div[@class='post-title']//h2")->item(0)->textContent ;
    $res["author"] = $xpath->query("//div[@class='post-title']//p/a")->item(0)->textContent ;
    $res["content"] = substr(explode("</div>", explode("post-content", $page)[1])[0], 2) ;
    return $res ;
}

if( $USER_ID && isset($_POST["urls"]) ){
    $urls = explode("\n", trim($_POST["urls"]) ) ;
    include("connect_db.php") ;
    foreach( $urls as $url ){
        unset($result) ;
        $page = file_get_contents($url) ;
        $doc = new DOMDocument ;
        $doc->loadHTMLFile($url) ;
        $xpath = new DOMXPath($doc) ;

        if(preg_match("/journaldugeek/", $url)){
            $result = jdg($xpath, $page) ;
        } else {
             ;
        }
        // echo "ICI $result" ;
        if(isset($result)){
            echo $tilte = $result["title"] ;
            echo $author = $result["author"] ;
            echo $content = $result["content"] ;
            $query = "INSERT INTO newz(url, title, author, content, create_uid, dt_creation) VALUES('$url', '$title', '$author', '$content', $USER_ID, NOW()) ;" ;
            mysqli_query($link, $query) or die("ERROR SQL : $query") ;
        }

    }
}
// header( "Location: home.php" ) ;