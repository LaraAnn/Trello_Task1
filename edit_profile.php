<!DOCTYPE html>
<html>
    <head>
        <?php
            include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();

            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $days = 1;
            $year= 1950;
            $current = date("Y");

//            $_SESSION['userId']
            if(isset($_SESSION['success']))
            {
                if($_SESSION['success'] == 1)
                {
                    echo "<script>alert('success!');</script>";
                    $_SESSION['success'] = 0;
                }
            }
        ?>
        <link rel="stylesheet" type="text/css" href="css/template_style.css">
        <title>SMARTink</title>
        
        <style>
            .text
            {
                padding: 5px;
                width: 95%;
            }
            
            .button
            {
                margin: 0px 5px;
                padding: 5px;
            }
            
            #signInForm table tr td
            {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <?php templateHeader();?>
        <div id='bodyContent'>
            <div id='editProfile' style='background-color: rgba(255, 255, 255, 0.8); box-shadow: 0px 0px 10px rgba(0, 0, 0, .8); border-radius: 5px; padding: 10px; margin: 20px;' align='center'>
                <?php
                    if(isset($_POST['update']))
                    {
                        editForm_update();
                    }
                    else
                    {
                        editForm($months, $year, $current);
                    }

                    function editForm($months, $year, $current)
                    {
                        $sqlQuery = "SELECT * FROM user_info WHERE user_id='" . $_SESSION['userId'] . "'";
                        $sendQuery = mysql_query($sqlQuery) or die("ERROR: at profile >> " . mysql_error());
                        while($data = mysql_fetch_assoc($sendQuery))
                        {
                            $date = explode("-", $data['birthdate']);
                            echo "  <form id='signInForm' name='signInForm' method='post' action='edit_profile.php'>
                                        <table cellpadding='0' cellspacing='0' border='0' width='40%'>
                                            <tr><td colspan='2'><h1>Edit Profile</h1><hr /><br /></td></tr>
                                            <tr>
                                                <td width='40%'>First Name: </td><td><input type='text' name='fName' id='fName' class='text' required value='" . $data['first_name'] . "'></td>
                                            </tr>
                                            <tr>
                                                <td>Middle Name: </td><td><input type='text' name='mName' id='mName' class='text' required value='" . $data['middle_name'] . "'></td>
                                            </tr>
                                            <tr>
                                                <td>Last Name: </td><td><input type='text' name='lName' id='lName' class='text' required value='" . $data['last_name'] . "'></td>
                                            </tr>
                                            <tr>
                                                <td>E-mail Address: </td><td><input type='email' name='eMail' id='eMail' class='text' required value='" . $data['email_address'] . "'></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>";
                            if($data['gender'] == 'male')
                            {
                                echo "              <label><input type='radio' name='gender' id='gender' value='male' checked />Male</label> &nbsp;
                                                    <label><input type='radio' name='gender' id='gender' value='female' />Female</label>";
                            }
                            else
                            {
                                echo "              <label><input type='radio' name='gender' id='gender' value='male' />Male</label> &nbsp;
                                                    <label><input type='radio' name='gender' id='gender' value='female' checked />Female</label>";
                            }
                            echo "              </td>
                                            </tr>
                                            <tr>
                                                <td>Birth Date:</td>
                                                <td>
                                                    <select name='mOnth' id='mOnth'>
                                                        <option value='x'>--Month--</option>";
                            for($x = 0; $x < count($months); $x++)
                            {
                                if($date[0] == $months[$x])
                                {
                                    echo "                  <option value='" . $months[$x] . "' selected>" . $months[$x] . "</option>";
                                }
                                else
                                {
                                    echo "                  <option value='" . $months[$x] . "'>" . $months[$x] . "</option>";
                                }
                            }
                            
                            echo "                                
                                                    </select>
                                                    <select name='dAy' id='dAy'>
                                                        <option value='x'>--Day--</option>";
                            for($x = 0; $x < 31; $x++)
                            {
                                if(($x + 1) == $date[1])
                                {
                                    echo "                  <option value='" . ($x + 1) . "' selected>" . ($x + 1) . "</option>";
                                }
                                else
                                {
                                    echo "                  <option value='" . ($x + 1) . "'>" . ($x + 1) . "</option>";
                                }
                            }                           
                            
                            echo "                  </select>
                                                    <select name='yEar' id='yEar'>
                                                        <option value='x'>--Year--</option>";
                            for($x = $year; $x < $current; $x++)
                            {
                                if($date[2] == $x)
                                {
                                    echo "<option value='" . $x . "' selected>" . $x . "</option>";
                                }
                                else
                                {
                                    echo "<option value='" . $x . "'>" . $x . "</option>";
                                }
                            }
                            
                            echo "                  </select>
                                                </td>
                                            </tr>
                                            <tr><td>Address</td><td><input type='text' class='text' name='address' id='address' value='" . $data['address'] . "' required></td></tr>
                                            <tr><td colspan='2'><br /><hr /></td></tr>
                                            <tr>
                                                <td colspan='2' align='center'>
                                                    <input type='submit' value='Save changes' class='button'>
                                                </td>
                                            </tr>
                                        </table>
                                        <input type='hidden' name='update' id='update' value='1'>
                                    </form>";
                        }
                    }

                    function editForm_update()
                    {
                        $sqlQuery ="UPDATE user_info SET first_name='" . $_POST['fName'] . "', middle_name='" . $_POST['mName'] . "', last_name='" . $_POST['lName'] . "', email_address='" . $_POST['eMail'] . "', gender='" . $_POST['gender'] . "', birthdate='" . $_POST['mOnth'] . "-" . $_POST['dAy'] . "-" . $_POST['yEar'] . "', address='" . $_POST['address'] . "' WHERE user_id='" . $_SESSION['userId'] . "'";
                        mysql_query($sqlQuery) or die("ERROR: at updating user_info >> " . mysql_error());
                        $_SESSION['success'] = 1;
                        header("Location:edit_profile.php?success=1");
                    }
                ?>
            </div>
        </div>
        <?php templateFooter();?>
    </body>
</html>