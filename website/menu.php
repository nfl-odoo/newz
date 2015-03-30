<!DOCTYPE html>
<html>
<head>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            position: fixed;
            top: 10%;
            left: -125px;
        }

        ul:hover {
            animation: show_menu 1s forwards;
        }

        @keyframes show_menu {
            from {left: -120px;}
            to {left: 0px;}
        }

        li.menu, a:link, a:visited {
            display: block;
            font-weight: bold;
            color: #FFFFFF;
            background-color: #98bf21;
            width: 120px;
            text-align: center;
            padding: 4px;
            text-decoration: none;
            text-transform: uppercase;
        }

        li.menu {
            height: 20px;
            width: 140px;
        }

        a:hover, a:active {
            background-color: #7A991A;
        }
    </style>
</head>
<body>

<ul>
    <li class="menu">Menu<li>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="login/login.php">Login</a></li>
</ul>

</body>
</html>