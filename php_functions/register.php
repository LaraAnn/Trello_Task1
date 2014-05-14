<?php
    require_once("dbconn.php");
    $db = new db();
    $db->connect();

    $firstName = $_POST['fName'];
    $middleName = $_POST['mName'];
    $lastName = $_POST['lName'];
    $eMailAdd = $_POST['eMail'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['mOnth'] . "-" . $_POST['dAy'] . "-" . $_POST['yEar']; // dito ang last >>>>>>>>>>>>>>>>>> XXxXXXXXXX
    $address = $_POST['address'];
    $uName = $_POST['uName'];
    $passWord = $_POST['passWord'];
    $confirmPass = $_POST['confirm'];

    $uIdExist = 0;
    $error = 0;

    session_start();
    $_SESSION['signInData'] = array($firstName, $middleName, $lastName, $eMailAdd, $gender, $birthDate, $uName, $address);


    if($passWord != $confirmPass) //checks if the password is equal to confirm password
    {
        $error = 2;
        header("Location:../sign_up.php?error=2");
    }
    else if(strlen($_POST['passWord']) < 8 || strlen($_POST['uName']) < 6) //checks the length of username if it is 6 characters or not and for password if it is less than 8
    {
        $error = 1;
        header("Location:../sign_up.php?error=1");
    }
    else if($_POST['mOnth'] == 'x' || $_POST['dAy'] == 'x' || $_POST['yEar'] == 'x') //checks if the user chose a date
    {
        $error = 3;
        header("Location:../sign_up.php?error=3");
    }
    $sqlQuery = "SELECT * FROM user_info";
    $sendQuery = mysql_query($sqlQuery) or die("at username checking >> " . mysql_error());
    while($data = mysql_fetch_assoc($sendQuery))
    {
        if($uName == $data['username']) //checks if the username has already been taken
        {
            $uIdExist = 1;
        }
    }

    if($uIdExist != 0) //if uName has a match, returns to the sign up form
    {
        header("Location:../sign_up.php?error=4");
    }
    else if($error != 0)
    {
        header("Location:../sign_up.php?error=" . $error);
    }
    else
    {
        $sqlQuery = "INSERT INTO user_info(username, password, first_name, middle_name, last_name, email_address, gender, birthdate, address) VALUES ('" . $uName . "', '" . $passWord . "', '" . $firstName . "', '" . $middleName . "', '" . $lastName . "', '" . $eMailAdd . "', '" . $gender . "', '" . $birthDate . "', '" . $address . "')";
        $sendQuery = mysql_query($sqlQuery) or die("at registering >> " . mysql_error());
//        session_destroy();
        $_SESSION['passWord'] = $passWord;
        header("Location:../reg_success.php");
    }
?>