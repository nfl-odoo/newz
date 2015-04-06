<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php

include_once("odoo.php") ;

$DEFAULT_DB = "newz" ;
$DEFAULT_SERVER = "localhost:9000" ;
$DEFAULT_LOGIN = "admin" ;
$DEFAULT_PWD = "admin" ;

// Connection (optional to speedup)
$TMP_CONNECTION = connect() ;

// Create user
$model = "res.users" ;
$vals = array(["name", "test"], ["login", "test"]) ;
echo "<br/><br/> Create User, return id <br/>" ;
print_r(create($model, $vals)) ;

// Read from users: id, name, login
$fields = array("id", "name", "login") ;
echo "<br/><br/> Read from users, return list of lists with data <br/>" ;
print_r(read($model, $fields)) ;

// Change login of "test"
$vals = array(["login", "new test"]) ;
$domain = array(array("name", "=", "test")) ;
echo "<br/><br/> Change login of user 'test', return 1 if success<br/>" ;
print_r(write($model, $vals, $domain)) ;

// Read from users with domain
echo "<br/><br/> Read from users with domain, return list of lists with data<br/>" ;
print_r(read($model, $fields, $domain)) ;

// Delete "test" user
echo "<br/><br/> Delete 'test' user, return 1 if success <br/>" ;
print_r(remove($model, $domain)) ;

// Read from users
echo "<br/><br/> Read from users, return list of list with data <br/>" ;
print_r(read($model, $fields)) ;