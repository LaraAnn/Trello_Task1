<?php
    require_once("dbconn.php");
    $db = new db();
    $db->connect();
    
    session_start();
    $sqlQuery = "SELECT * FROM admin_info";
    $sendQue = mysql_query($sqlQuery);
    $status = 0;

    if($sendQue)
    {
        while($getData = mysql_fetch_assoc($sendQue))
        {
            if($getData['admin_user'] == $_POST['adminUser'] && $getData['admin_pass'] == $_POST['adminPass'])
            {
                $status = 1;
                $user = $getData['admin_user'];
                $pass = $getData['admin_pass'];
            }
        }
        
        if($status == 1)
        {
            $_SESSION['admin'] = $user;
            header("Location:../index.php");
        }
        else
        {
            header("Location:../admin.php?pass=0");
        }
    }
    else
    {
        die(mysql_error());
    }
?>