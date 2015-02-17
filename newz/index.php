<ul id="menu">
    <li><a href="home.php">Home Page</a></li>
    <li><a href="newz.php">Newz</a></li>
<?php if( $USER_ID ){ ?>
    <?php if( $USER_RANK == "admin" ) { ?>
    <li><a href="add_newz.php">Add Newz</a></li>
    <li><a href="proposed_newz.php">Proposed Newz</a></li>
    <?php } else { ?>
    <li><a href="propose_newz.php">Propose Newz</a></li>
    <?php } ?>
    <li><a href="session_close.php">LogOut</a></li>
<?php } else { ?>
    <li><a href="register.php">Register</a></li>
    <li><a href="log_in.php">LogIn</a></li> 
<?php } ?>
</ul>