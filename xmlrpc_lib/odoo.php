<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php

/*
    Possible errors of requests are redirected into the apache log file.

    $login & $pwd are the login and password used to connect to the server.
    $dbname & $server_url are the database name and server url to witch connect.
    By default, GLOBAL : DEFAULT_LOGIN, DEFAULT_PWD, DEFAULT_DB, DEFAULT_SERVER.

    $domain is an array of arrays containing the domain conditions.
    Ex : $domain = array(array("id", "<", 10), array("name", "ilike", "adm")) ;

    $fields is an array of fields to read.
    Ex : $fields = array("id", "name") ;

    $vals is an array of arrays(fields, value) to create or write.
    Ex : $vals = array(["name", "test"], ["login", "test"]) ;

    $model is the model from with to read, write or create.
    Ex : $model = "res.users" ;
*/

include_once("xmlrpc.inc") ;
include_once("xmlrpcs.inc") ;
$GLOBALS["xmlrpc_internalencoding"] = "UTF-8" ;

function print_apache_log($error){
    file_put_contents("php://stderr", print_r("\n===== ERROR =====\n$error\n====== END ======\n", TRUE)) ;
    return -1 ;
}

function xmlrpc_fields($fields){
    $field_list = array() ;
    foreach($fields as $field){
        $field_list[] = new xmlrpcval($field) ;
    }
    return $field_list ;
}

function xmlrpc_ids($ids){
    $id_list = array() ;
    foreach($ids as $id){
        $id_list[] = new xmlrpcval($id->me["int"], "int") ;
    }
    return $id_list ;
}

function xmlrpc_vals($vals){
    $val_list = array() ;
    foreach($vals as $val){
        $val_list[$val[0]] = new xmlrpcval($val[1]) ;
    }
    return $val_list ;
}

function xmlrpc_domain($domain){
    if(!isset($domain)) return array() ;
    $domain_list = array() ;
    foreach($domain as $values){
        if(count($values) == 3){
            $domain_list[] = new xmlrpcval(
                array(
                    new xmlrpcval($values[0]),
                    new xmlrpcval($values[1]),
                    new xmlrpcval($values[2]),
                ), "array"
            ) ;
        } else {
            $domain_list[] = new xmlrpcval($values) ;
        }
    }
    return $domain_list ;
}

function connect($login=NULL, $pwd=NULL, $dbname=NULL, $server_url=NULL){
    $dbname = isset($dbname) ? $dbname : $GLOBALS["DEFAULT_DB"] ;
    $server_url = isset($server_url) ? $server_url : $GLOBALS["DEFAULT_SERVER"] ;
    $login = isset($login) ? $login : $GLOBALS["DEFAULT_LOGIN"] ;
    $pwd = isset($pwd) ? $pwd : $GLOBALS["DEFAULT_PWD"] ;

    $connexion = new xmlrpc_client($server_url."/xmlrpc/common") ;
    $connexion->setSSLVerifyPeer(0) ;

    $c_msg = new xmlrpcmsg("login") ;
    $c_msg->addParam(new xmlrpcval($dbname, "string")) ;
    $c_msg->addParam(new xmlrpcval($login, "string")) ;
    $c_msg->addParam(new xmlrpcval($pwd, "string")) ;
    return $connexion->send($c_msg);
}

function create($model, $vals, $login=NULL, $pwd=NULL, $dbname=NULL, $server_url=NULL){
    $dbname = isset($dbname) ? $dbname : $GLOBALS["DEFAULT_DB"] ;
    $server_url = isset($server_url) ? $server_url : $GLOBALS["DEFAULT_SERVER"] ;
    $login = isset($login) ? $login : $GLOBALS["DEFAULT_LOGIN"] ;
    $pwd = isset($pwd) ? $pwd : $GLOBALS["DEFAULT_PWD"] ;

    $c_response = isset($GLOBALS["TMP_CONNECTION"]) ? $GLOBALS["TMP_CONNECTION"] : connect() ;
    if($c_response->errno) return print_apache_log($c_response->faultString()) ;

    $uid = $c_response->value()->scalarval();

    $client = new xmlrpc_client($server_url."/xmlrpc/object") ;
    $client->setSSLVerifyPeer(0) ;

    $msg = new xmlrpcmsg("execute") ;
    $msg->addParam(new xmlrpcval($dbname, "string")) ;
    $msg->addParam(new xmlrpcval($uid, "int")) ;
    $msg->addParam(new xmlrpcval($pwd, "string")) ;
    $msg->addParam(new xmlrpcval($model, "string")) ;
    $msg->addParam(new xmlrpcval("create", "string")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_vals($vals), "struct")) ;
    $response = $client->send($msg) ;
    
    if($response->errno) return print_apache_log($response->faultString()) ;

    return $response->val->me["int"] ;
}

function search_ids($model, $domain=NULL, $login=NULL, $pwd=NULL, $dbname=NULL, $server_url=NULL){
    $dbname = isset($dbname) ? $dbname : $GLOBALS["DEFAULT_DB"] ;
    $server_url = isset($server_url) ? $server_url : $GLOBALS["DEFAULT_SERVER"] ;
    $login = isset($login) ? $login : $GLOBALS["DEFAULT_LOGIN"] ;
    $pwd = isset($pwd) ? $pwd : $GLOBALS["DEFAULT_PWD"] ;

    $c_response = isset($GLOBALS["TMP_CONNECTION"]) ? $GLOBALS["TMP_CONNECTION"] : connect() ;
    if($c_response->errno) return print_apache_log($c_response->faultString()) ;

    $uid = $c_response->value()->scalarval() ;
    $client = new xmlrpc_client($server_url . "/xmlrpc/object") ;
    $client->setSSLVerifyPeer(0) ;

    $msg = new xmlrpcmsg("execute") ;
    $msg->addParam(new xmlrpcval($dbname, "string")) ;
    $msg->addParam(new xmlrpcval($uid, "int")) ;
    $msg->addParam(new xmlrpcval($pwd, "string")) ;
    $msg->addParam(new xmlrpcval($model, "string")) ;
    $msg->addParam(new xmlrpcval("search", "string")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_domain($domain), "array")) ;
    $response = $client->send($msg) ;
      
    if($response->errno) return print_apache_log($response->faultString()) ;
    return [$response->value()->scalarval(), $c_response, $client] ;
}

function read($model, $fields, $domain=NULL, $login=NULL, $pwd=NULL, $dbname=NULL, $server_url=NULL){
    $dbname = isset($dbname) ? $dbname : $GLOBALS["DEFAULT_DB"] ;
    $server_url = isset($server_url) ? $server_url : $GLOBALS["DEFAULT_SERVER"] ;
    $login = isset($login) ? $login : $GLOBALS["DEFAULT_LOGIN"] ;
    $pwd = isset($pwd) ? $pwd : $GLOBALS["DEFAULT_PWD"] ;

    $search = search_ids($model, $domain) ;
    if($search == -1) return -1 ;
    list($ids, $c_response, $client) = $search ;

    $uid = $c_response->value()->scalarval() ;

    $msg = new xmlrpcmsg("execute") ;
    $msg->addParam(new xmlrpcval($dbname, "string")) ;
    $msg->addParam(new xmlrpcval($uid, "int")) ;
    $msg->addParam(new xmlrpcval($pwd, "string")) ;
    $msg->addParam(new xmlrpcval($model, "string")) ;
    $msg->addParam(new xmlrpcval("read", "string")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_ids($ids), "array")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_fields($fields), "array")) ;
    $resp = $client->send($msg) ;

    if ($resp->errno) return print_apache_log($resp->faultString()) ;

    $result = array() ;
    foreach($resp->value()->scalarval() as $key => $response){
        $result[$key] = array() ;
        foreach($fields as $field){
            $tmp = $response->me["struct"][$field]->me ;
            $result[$key][$field] = $tmp[array_keys($tmp)[0]] ;
        }
    }
    return $result ;
}

function remove($model, $domain, $login=NULL, $pwd=NULL, $dbname=NULL, $server_url=NULL){
    $dbname = isset($dbname) ? $dbname : $GLOBALS["DEFAULT_DB"] ;
    $server_url = isset($server_url) ? $server_url : $GLOBALS["DEFAULT_SERVER"] ;
    $login = isset($login) ? $login : $GLOBALS["DEFAULT_LOGIN"] ;
    $pwd = isset($pwd) ? $pwd : $GLOBALS["DEFAULT_PWD"] ;

    $search = search_ids($model, $domain) ;
    if($search == -1) return -1 ;
    list($ids, $c_response, $client) = $search ;

    $uid = $c_response->value()->scalarval() ;

    $msg = new xmlrpcmsg("execute") ;
    $msg->addParam(new xmlrpcval($dbname, "string")) ;
    $msg->addParam(new xmlrpcval($uid, "int")) ;
    $msg->addParam(new xmlrpcval($pwd, "string")) ;
    $msg->addParam(new xmlrpcval($model, "string")) ;
    $msg->addParam(new xmlrpcval("unlink", "string")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_ids($ids), "array")) ;
    $response = $client->send($msg);

    if($response->errno) return print_apache_log($response->faultString()) ;
    return $response->val->me["boolean"] ;
}

function write($model, $vals, $domain, $login=NULL, $pwd=NULL, $dbname=NULL, $server_url=NULL){
    $dbname = isset($dbname) ? $dbname : $GLOBALS["DEFAULT_DB"] ;
    $server_url = isset($server_url) ? $server_url : $GLOBALS["DEFAULT_SERVER"] ;
    $login = isset($login) ? $login : $GLOBALS["DEFAULT_LOGIN"] ;
    $pwd = isset($pwd) ? $pwd : $GLOBALS["DEFAULT_PWD"] ;

    $search = search_ids($model, $domain);
    if($search == -1) return -1 ;
    list($ids, $c_response, $client) = $search ;

    $uid = $c_response->value()->scalarval() ;

    $msg = new xmlrpcmsg('execute') ;
    $msg->addParam(new xmlrpcval($dbname, "string")) ;
    $msg->addParam(new xmlrpcval($uid, "int")) ;
    $msg->addParam(new xmlrpcval($pwd, "string")) ;
    $msg->addParam(new xmlrpcval($model, "string")) ;
    $msg->addParam(new xmlrpcval("write", "string")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_ids($ids), "array")) ;
    $msg->addParam(new xmlrpcval(xmlrpc_vals($vals), "struct")) ;
    $response = $client->send($msg) ;

    if ($response->errno) return print_apache_log($response->faulString()) ;
    return $response->val->me["boolean"] ;
}

?>