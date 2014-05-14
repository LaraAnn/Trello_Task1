<!doctype html>
<html>
    <head>
        <?php
            session_start();
        ?>
        <title>SMARTink</title>
        <style>
            *
            {
                padding: 0px;
                margin: 0px;
                font-family: "calibri", "arial";
            }
            
            .link td
            {
                padding: 10px;
            }
            
            .link a
            {
                color: blue;
            }
            
            table h2
            {
                background-color: black;
                color: white;
                padding: 5px;
            }
            
            table
            {
                margin: 20px 30px;
                border: 2px solid black;
            }
            
            .minor td, .explicit td
            {
                padding: 5px;
            }
            
            .warning td
            {
                color: red;
                padding: 0px 10px;
            }
        </style>
    </head>
    <body>
        <div align="center">
            <table cellspacing="0" cellpadding="0" border="0">
                <tr><td colspan="2" align="center"><h2>Registration Succesful!</h2></td></tr>
                <tr><td colspan="2"><hr /><br /></td></tr>
                <tr class="minor">
                    <td>Name: </td><td><?php echo $_SESSION['signInData'][0] . " " . $_SESSION['signInData'][1] . " " . $_SESSION['signInData'][2];?></td>
                </tr>
                <tr class="minor">
                    <td>E-mail Address: </td><td><?php echo $_SESSION['signInData'][3];?></td>
                </tr>
                <tr class="minor">
                    <td>Gender: </td><td><?php echo $_SESSION['signInData'][4];?></td>
                </tr>
                <tr class="minor">
                    <td>Birthdate: </td><td><?php echo $_SESSION['signInData'][5];?></td>
                </tr>
                <tr class="minor">
                    <td>Address: </td><td><?php echo $_SESSION['signInData'][7];?></td>
                </tr>
                <tr><td colspan="2"><br /><hr /><br /></td></tr>
                <tr class="explicit">
                    <td>Username: </td><td><?php echo $_SESSION['signInData'][6];?></td>
                </tr>
                <tr class="explicit">
                    <td>Password: </td><td><?php echo $_SESSION['passWord'];?></td>
                </tr>
                <tr><td colspan="2"><br /><hr /><br /></td></tr>
                <tr class="warning"><td colspan="2">*A copy of this form will be send to your E-mail</td></tr>
                <tr class="link"><td colspan="2" align="center"><a href="login.php"><< Go Back to Login Page</a></td></tr>
            </table>
        </div>
    </body>
</html>