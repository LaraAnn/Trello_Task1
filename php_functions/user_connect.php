<?php
    require_once("dbconn.php");
    $db = new db();
    $db->connect();

    session_start();
    $sqlQuery = "SELECT * FROM user_info";
    $sendQue = mysql_query($sqlQuery) or die(mysql_error());
    $status = 0;

    while($getData = mysql_fetch_assoc($sendQue))   
    {
        if($getData['username'] == $_POST['userUser'] && $getData['password'] == $_POST['userPass'])
        {
            $status = 1;
            $user = $getData['username'];
            $userID = $getData['user_id'];
            $firstName = $getData['first_name'];
        }
    }
    
    if($status == 1)
    {
        $_SESSION['user'] = $user;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['userId'] = $userID;
        $_SESSION['transArrayNumber'] = 0;
        header("Location:../index.php");
    }
    else if($status == 0)
    {
        header("Location:../login.php?pass=0");
    }
?>