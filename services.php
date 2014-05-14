<!DOCTYPE html>
<html>
	<head>
		<?php
			include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
            
            if(isset($_SESSION['user']))
            {
                if(file_exists("client_transactions/" . $_SESSION['user'] . "sample.jpg"))
                {
                    unlink("client_transactions/" . $_SESSION['user'] . "sample.jpg");
                }
            }
		?>
		<link rel="stylesheet" href="css/template_style.css" type="text/css" />
		<link rel="stylesheet" href="css/services.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/editor.css" />
        <link rel="stylesheet" type="text/css" href="php_functions/jquery_styles.php" />
        <script src="jquery-2.0.3.js"></script>
		<script src="services.js"></script>
		<script src="functions.js"></script>
        <title> SMARTink </title>
	</head>
	<body>
		<?php
			templateHeader();
		?>
		<div id="bodyContent">
            <table border="0" cellspacing="0" width="100%" valign="top">
				<tr>
					<td id="leftContent" width="30%" valign="top">
						<div id="innerContent">
							<h1>Services</h1>
							<hr /> <br />
							<a name="serviceType" value="0" onclick="$('#rightContent #innerContent').load('services_offered.php #tarpServiceIndex');">Tarpaulin Printing</a> <br />
							<a name="serviceType" value="1" onclick="$('#rightContent #innerContent').load('services_offered.php #shirtServiceIndex');">Shirt Printing</a> <br />
							<a name="serviceType" value="3" onclick="$('#rightContent #innerContent').load('services_offered.php #callingCardsServicesIndex');">Calling Card</a> <br />
							<a name="serviceType" value="2" onclick="$('#rightContent #innerContent').load('services_offered.php #otherServices');">Other Services</a> <br />
						</div>
                        <div id='cartContent'>
                            <h2>Cart</h2>
                            <hr /> <br />
                            <div id='cart'>
                                <?php
                                    echo "  <form method='post' action='review_cart.php?action=0'>
                                                <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                                    <tr><th>Service</th><th>Price</th><th>Options</th></tr>";
                                    
                                    if(isset($_SESSION['admin']))
                                    {
                                        echo "      <tr><td colspan='3'></td></tr>";
                                        echo "  </table>
                                                <div align='center' id='submitBtn'><input type='Button' value='Send Request' /></div>
                                            </form>";
                                    }
                                    else if(isset($_SESSION['user']))
                                    {
                                        $sqlQuery = "SELECT * FROM cart_temp";
                                        $sendQuery = mysql_query($sqlQuery) or die("ERROR : at getting cart_temp" . mysql_error());
                                        $isEmpty = 1;
                                        $ctr = 0;
                                        while($data = mysql_fetch_assoc($sendQuery))
                                        {
                                            $isEmpty = 0;
                                            if($data['is_ignored'] != 1)
                                            {
                                                echo "  <tr>
                                                            <td align='center'>" . $data['service_type'] . "</td>
                                                            <td align='center'>" . $data['price'] . "</td>
                                                            <td align='center'>
                                                            <a href='php_functions/cart_temp_extra.php?mode=edit&cart_id=" . $data['cart_id'] . "'>Edit</a> | <a onclick=\"confirmAction('This request will be deleted. Continue?', '2', '" . $ctr . "');\" href='#'>Delete</a>
                                                            <input type='hidden' name='cart_id" . $ctr . "' id='cart_id" . $ctr . "' value='" . $data['cart_id'] . "'>
                                                            <input type='hidden' name='number" . $ctr . "' id ='number" . $ctr . "' value='" . $ctr . "'>
                                                            </td>
                                                        </tr>";
                                            }
                                            $ctr += 1;
                                        }
                                        if($isEmpty == 0)
                                        {
                                            echo "  </table>
                                                    <div align='center' id='submitBtn'><input type='submit' value='Send Request' /></div>
                                                </form>";
                                        }
                                        else if($isEmpty == 1)
                                        {
                                            echo "          <tr><td colspan='3' align='center'></td></tr>";
                                            echo "  </table>
                                                    <div align='center' id='submitBtn'><input type='button' value='Send Request' /></div>
                                                </form>";
                                        }
                                    }
                                    else
                                    {
                                        echo "          <tr><td colspan='3' align='center'>Sign in first before you transact. Thank you.</td></tr>";
                                        echo "      </table>
                                                    <div align='center' id='submitBtn'><input type='Button' value='Send Request' /></div>
                                                </form>";
                                    }
                                ?>
                            </div>
                        </div>
					</td>
					<td id="rightContent" width="70%" valign="top">
						<div id="innerContent">
							<div id="serviceIntro">
                                <div style="position: absolute; margin-left: 80px; margin-top: 220px; font-size: 32px;"><b>Tarpaulin Printing</b></div>
                                <div style="position: absolute; margin-left: 500px; margin-top: 220px; font-size: 32px;"><b>Shirt Printing</b></div>
                                <div style="position: absolute; margin-left: 320px; margin-top: 560px; font-size: 32px;"><b>Calling Card</b></div>
<!--								<h2>Select Services on the left panel to begin</h2>-->
                                <div style="margin-top: 30px;" id="thumbnails">
                                    <img src="images/tarp2b3.jpeg" width="300" style="margin-left: 50px; cursor: pointer; transition: .1s;" onclick="$('#rightContent #innerContent').load('services_offered.php #tarpServiceIndex');"><img src="images/tarp2b4.jpg" width="300" style="margin-left: 90px; cursor: pointer; transition: .1s;" onclick="$('#rightContent #innerContent').load('services_offered.php #shirtServiceIndex');"><img src="images/tarp3b4.jpg" width="300" style="margin-left: 240px; cursor: pointer; margin-top: 50px; transition: .1s;" onclick="$('#rightContent #innerContent').load('services_offered.php #callingCardsServicesIndex');">
                                </div>
							</div>
						</div>
					</td>
				</tr>
			</table>
        </div>
		<?php
			templateFooter();
		?>
	</body>
</html>