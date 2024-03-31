<?php 

// define all variables for connection

$db_serv = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'forumapp';

// make the connection

try 
{
    $db_conn = new mysqli($db_serv, $db_user, $db_pass, $db_name);
    mysqli_set_charset($db_conn, "utf8");

}
catch(Exception $err)
{
    echo "An Error accured: {$err->getMessage()}";
}


?>
