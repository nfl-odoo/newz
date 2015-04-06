<html>
<head>
    <style>
        body{
            background-color: lavender;
        }
        ul{
            list-style-type: none;
            background-color: #818187;
            height: 100%;
            width: 180px;
            position: fixed;
            left: -220px;
            top: -16px;
            z-index: 16;
        }

        ul.menu_lock{
            left: -50px;
        }

        li, a{
            display: block;
            font-weight: bold;
            color: #FFFFFF;
            background-color: #818187;
            text-align: center;
            padding: 4px;
            text-decoration: none;
            text-transform: uppercase;
        }

        li.top_ulock{
            opacity: .4;
            padding: 0px;
            width: 220px;
            height: 40px;
            text-align: right;
        }

        li.top_lock{
            opacity: 1;
            padding: 0px;
            width: 180px;
            height: 40px;
            text-align: right;
        }

        a:hover{
            background-color: #616169;
        }

        img{
            height: 40px;
            width: 40px;
        }

        ul.menu_ulock:hover {
            animation: show_menu 1s forwards;
        }

        @keyframes show_menu {
            from {left: -220px;}
            to {left: -50px;}
        }

        div.main_lock{
            /*background-color: red;*/
            width: calc(100% - 162px);
            left: 162px;
            top: -8px;
            position: relative;
        }

        div.main_ulock{
            /*background-color: red;*/
            width: calc(100% - 16px);
            left: -8px;
            top: -8px;
            position: relative;
        }

    </style>
    <script>
        function menu_lock(){
            var menu_lock = document.getElementsByClassName("menu_lock");
            var menu_ulock = document.getElementsByClassName("menu_ulock");
            var main_lock = document.getElementsByClassName("main_lock") ;
            var main_ulock = document.getElementsByClassName("main_ulock") ;
            var top_lock = document.getElementsByClassName("top_lock") ;
            var top_ulock = document.getElementsByClassName("top_ulock") ;
            var len_lock = menu_lock.length
            var len_ulock = menu_ulock.length
            if(len_lock){
                menu_lock[0].className = "menu_ulock";
                main_lock[0].className = "main_ulock";
                top_lock[0].className = "top_ulock";
            }
            if(len_ulock){
                menu_ulock[0].className = "menu_lock";
                main_ulock[0].className = "main_lock";
                top_ulock[0].className = "top_lock";
            }
        }
    </script>
</head>
<body>

<ul class="menu_ulock" onclick="menu_lock()">
    <li class="top_ulock"><img src="images/menu.png"/></li>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="newz.php">Newz</a></li>
    <li><a href="login.php">Login</a></li>
</ul>

</body>
</html>