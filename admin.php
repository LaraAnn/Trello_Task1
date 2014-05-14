<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/admin.css" />
        <link rel="stylesheet" type="text/css" href="css/editor.css" />
        <title> SMARTink </title>
        <?php
            session_start();
            if(isset($_SESSION['admin']))
            {   
                header("Location:index.php");
            }
            else if(isset($_SESSION['user']))
            {   
                header("Location:index.php");
            }
        ?>
    </head>
    <body>
		<form method="post" action="php_functions/admin_connect.php">
			<table cellspacing="0" cellpadding="0" border="0" align="center">
				<tr>
					<td colspan="2" id="header"><img src="images/SMARTinkLogo.png" width="250px" height="70px" /> Admin page</td>
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
					<td>Admin Username:</td>
					<td align="right"><input type="text" id="adminUser" name="adminUser" required autofocus /></td>
				</tr>
				<tr id="logInBox">
					<td>Admin Password:</td>
					<td align="right"><input type="password" id="adminPass" name="adminPass" required /></td>
				</tr>
				<tr>
				<td colspan="2" align="center" id="submitBtn"><input type="submit" value="Log in" /></td>
				</tr>
			</table>
		</form>
    </body>
</html>