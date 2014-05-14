<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/admin.css" />
        <link rel="stylesheet" type="text/css" href="css/editor.css" />
        <title>SMARTink</title>
    </head>
    <body>
		<form method="post" action="php_functions/user_connect.php">
			<table cellspacing="0" cellpadding="0" border="0" align="center">
				<tr>
					<td colspan="2" id="header"><img src="images/SMARTinkLogo.png" width="250px" height="70px" /> Login page</td>
				</tr>
                <?php
                    if(isset($_GET['pass']))
                    {
                        echo "  <tr>";
                        echo "      <td colspan=\"2\" style=\"color: red;\">*Wrong username or password!</td>";
                        echo "  </tr>";
                    }
                ?>
				<tr id="logInBox">
					<td>Username:</td>
					<td align="right"><input type="text" id="userUser" name="userUser" required autofocus /></td>
				</tr>
				<tr id="logInBox">
					<td>Password:</td>
					<td align="right"><input type="password" id="userPass" name="userPass" required /></td>
				</tr>
				<tr>
					<td colspan="2" align="center" id="submitBtn"><input type="submit" value="Log in" /> or <a href="sign_up.php">Sign up</a></td>
				</tr>
			</table>
            <?php
                if(isset($_GET['message']))
                {
                    echo "<div align='center' style='color: red; padding: 5px;'>*registration succesful!</div>";
                }

            ?>
		</form>
    </body>
</html>