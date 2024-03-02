<?php 

    // make all the variables needed for the connection
    $db_server = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'loginapp';

    // make the connection
    try
    {
        $db_conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    }
    catch(mysqli_sql_exception $e)
    {
        echo "Could not connect with the database";
    }
?>
