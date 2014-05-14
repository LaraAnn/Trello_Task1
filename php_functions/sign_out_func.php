<?php
    require_once("dbconn.php");
    $db = new db();
    $db->connect();
    session_start();
    
    $sqlQuery = "DELETE FROM cart_temp";
    mysql_query($sqlQuery) or die(mysql_error());
    
    session_destroy();
    header("Location:../index.php");
?>