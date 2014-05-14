<!doctype html>
<html>
    <head>
        <?php
//            session_start();
            include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $days = 1;
            $year= 1950;
            $current = date("Y");
            for($x = 0; $x < 8; $x++)
            {
                $data[$x] = isset($_SESSION['signInData'][$x]) ? $_SESSION['signInData'][$x] : "";
            }

            if(isset($_SESSION['user']))
            {
                header("Location:login.php");
            }

            if($data[5] != "")
            {
                $datE = explode("-", $data[5]);
            }
            else
            {
                $datE[0] = 'x';
                $datE[1] = 0;
                $datE[2] = 0;
            }
        ?>
        <title>SMARTink</title>
        <link rel="stylesheet" type="text/css" href="css/template_style.css" />
        <link rel="stylesheet" type="text/css" href="css/sign_in.css" />
        <style>
            #anchor a
            {
                text-decoration: none;
                color: blue;
                transition: .1;
            }
            
            #anchor a:hover
            {
                text-decoration: underline;
                transition: .1;
            }
        </style>
    </head>
    <body>
        <?php
            templateHeader();
        ?>
        <div id="bodyContent">
            <div align="center" id="signInForm">
                <form method="post" action="php_functions/register.php" name="signUpForm" id="signUpForm">
                    <table cellspacing='0' cellpadding='0' border="0" width=40%>
                        <tr><td colspan="2"><h1>Sign up</h1><hr /><br /></td></tr>
                        <?php
                            if(isset($_GET['error']))
                            {
                                if($_GET['error'] == 1)
                                {
                                    echo "      <tr>
                                                    <td colspan='2' id='error'>";
                                    echo "              *Username must be at least six (6) characters long and Password must be at least eight (8) characters long!<br /><br />";
                                    echo "          </td>
                                                </tr>";
                                }
                                else if($_GET['error'] == 2)
                                {
                                    echo "      <tr>
                                                    <td colspan='2' id='error'>";
                                    echo "              *Passwords did not match!<br /><br />";
                                    echo "          </td>
                                                </tr>";
                                }
                                else if($_GET['error'] == 3)
                                {
                                    echo "      <tr>
                                                    <td colspan='2' id='error'>";
                                    echo "              *Choose a valid birthdate!<br /><br />";
                                    echo "          </td>
                                                </tr>";
                                }
                                else if($_GET['error'] == 4)
                                {
                                    echo "      <tr>
                                                    <td colspan='2' id='error'>";
                                    echo "              *Username already exist! Please choose another Username<br /><br />";
                                    echo "          </td>
                                                </tr>";
                                }
                            }
                        ?>
                        <tr>
                            <td width=40%>First Name: </td><td><input type="text" name="fName" id="fName" class="text" <?php echo "value='" . $data[0] . "'";?> required autofocus /></td>
                        </tr>
                        <tr>
                            <td>Middle Name: </td><td><input type="text" name="mName" id="mName" class="text" <?php echo "value='" . $data[1] . "'";?> required /></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td><td><input type="text" name="lName" id="lName" class="text" <?php echo "value='" . $data[2] . "'";?> required /></td>
                        </tr>
                        <tr>
                            <td>E-mail Address: </td><td><input type="email" name="eMail" id="eMail" class="text" <?php echo "value='" . $data[3] . "'";?> required /></td>
                        </tr>
                        <tr>
                            <td>Gender: </td>
                            <td>
                                <?php
                                    if($data[4] == 'male' || $data[4] == '')
                                    {
                                        echo "  <label><input type='radio' name='gender' id='gender' value='male' checked />Male</label> &nbsp;
                                                <label><input type='radio' name='gender' id='gender' value='female' />Female</label>";
                                    }
                                    else if($data[4] == 'female')
                                    {
                                        echo "  <label><input type='radio' name='gender' id='gender' value='male' />Male</label> &nbsp;
                                                <label><input type='radio' name='gender' id='gender' value='female' checked />Female</label>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Birth Date:</td>
                            <td>
                                <select name="mOnth" id="mOnth">
                                    <option value="x">--Month--</option>
                                    <?php
                                        for($x = 0; $x < count($months); $x++)
                                        {
                                            if($datE[0] == $months[$x])
                                            {
                                                echo "  <option value='" . $months[$x] . "' selected>" . $months[$x] . "</option>";
                                            }
                                            else
                                            {
                                                echo "  <option value='" . $months[$x] . "'>" . $months[$x] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <select name="dAy" id="dAy">
                                    <option value="x">--Day--</option>
                                    <?php
                                        for($x = 0; $x < 31; $x++)
                                        {
                                            if($datE[1] == ($x + 1))
                                            {
                                                echo "  <option value='" . ($x + 1) . "' selected>" . ($x + 1) . "</option>";
                                            }
                                            else
                                            {
                                                echo "  <option value='" . ($x + 1) . "'>" . ($x + 1) . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <select name="yEar" id="yEar">
                                    <option value="x">--Year--</option>
                                    <?php
                                        for($x = $year; $x < $current; $x++)
                                        {
                                            if($datE[2] == $x)
                                            {
                                                echo "<option value='" . $x . "' selected>" . $x . "</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='" . $x . "'>" . $x . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td>Address</td><td><input type="text" class="text" name='address' id='address' <?php echo "value='" . $data[7] . "'";?> required></td></tr>
                        <tr><td colspan="2"><br /><hr /><br /></td></tr>
                        <tr>
                            <td>Username:</td><td><input type="text" name="uName" id="uName" class="text" <?php echo "value='" . $data[6] . "'";?> required placeholder="Username must be at least 6 characters" /></td>
                        </tr>
                        <tr>
                            <td>Password: </td><td><input type="password" name="passWord" id="passWord" class="text" required placeholder="Password must be at least 8 characters"></td>
                        </tr>
                        <tr>
                            <td>Confirm Password: </td><td><input type="password" name="confirm" id="confirm" class="text" required placeholder="Re-type you password" /></td>
                        </tr>
                        <tr><td colspan="2"><br /><hr /></td></tr>
                        <tr><td colspan="2" align='center' id="anchor">By Signing up, you agree to our <a href="terms.html" target="_blank">terms and conditions</a></td></tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="Sign up" class="button" />
                                <input type="button" class="button" value="Reset" onclick="window.location.href = 'php_functions/reset.php'" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>    
        </div>
        <?php
            templateFooter();
        ?>
    </body>
</html>