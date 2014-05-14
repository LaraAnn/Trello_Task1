<!DOCTYPE html>
<html>
    <head>
        <title>SMARTink</title>
        <?php
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
            $approved = isset($_POST['approved']) ? $_POST['approved'] : "";
            session_start();
        ?>
        <style>
            
        </style>
        <script>
            function approved(iD, val)
            {
                document.getElementById(iD).value = val;
                window.formEdit.submit();
            }
        </script>
    </head>
    <body>
        <form method="post" action="review_cart.php" name="part" id="part">
            <table cellspacing="0" cellpadding="0" border="1" align='center' style='border: 1px solid black;'>
                <?php
                    if($approved != "")
                    {
                        sendToQueue();
                    }
                    else if($approved == "")
                    {
                        reView();
                    }

                    function reView()
                    {
                        echo "      <tr style='background-color: #555; color: white;'><th style='padding: 5px;'>Service Type</th><th>Size</th><th>Price</th><th>Remarks</th></tr>";
                        $sqlQuery = "SELECT * FROM cart_temp";
                        $sendQuery = mysql_query($sqlQuery) or die("ERROR: at reviewing services" . mysql_error());
    
                        while($data = mysql_fetch_assoc($sendQuery))
                        {
                            $size = explode("-", $data['size']);
                            
                            echo "  <tr>
                                        <td valign='top' align='center' style='padding: 5px;'>" . $data['service_type'] . "</td>
                                        <td valign='top' align='center' style='padding: 5px;'>" . $data['size'] . "</td>
                                        <td valign='top' align='center' style='padding: 5px;'>Php " . $data['price'] . "</td>
                                        <td align='center' width='300px' height='100px' style='padding: 5px;'><textarea readonly style='width:97%; height:100%; resize: none;'>" . $data['remarks'] . "</textarea></td>
                                    </tr>";
                        }
                        echo "      <tr><td colspan='4' align='center' style='color: red; padding: 5px;'>*if you proceed, you will receive an email regarding the payment.</td></tr><tr><td colspan=\"4\" align=\"center\">Proceed?<input type=\"button\" value=\"Yes\" onclick=\"document.getElementById('approved').value = '1';window.part.submit();\" /><input type=\"button\" value=\"No\" onclick='location.href = \"services.php\"' /></td></tr>";
                    }

                    function sendToQueue()
                    {
                        $sqlQuery = "SELECT * FROM cart_temp";
                        $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                        
                        $ctr = 0;
                        
                        while($data = mysql_fetch_assoc($sendQuery))
                        {
                            if($data['is_ignored'] == 0)
                            {
                                $array[$ctr][0] = $data['service_type'];
                                $array[$ctr][1] = $data['file_name'];
                                $array[$ctr][2] = $data['size'];
                                $array[$ctr][3] = $data['price'];
                                $array[$ctr][4] = $data['remarks'];
                            }
//                            echo($data[$ctr][0] . "<br />");
                            $ctr += 1;
                        }
//                        print_r($array);
                        
                        for($x = 0; $x < count($array); $x++)
                        {
                            $sqlQuery = "INSERT INTO transactions(user_id, service_type, file_name, size, price, remarks, receipt, status) VALUES('" . $_SESSION['userId'] . "', '" . $array[$x][0] . "', '" . $array[$x][1] . "', '" . $array[$x][2] . "', '" . $array[$x][3] . "', '" . $array[$x][4] . "', '" . rand(10000000, 99999999) . "', 'pending')";
                            $sendQuery = mysql_query($sqlQuery) or die("ERROR: at inserting transactions" . mysql_error());
                            copy("client_transactions/pictures/temporary/" . $array[$x][1], "client_transactions/pictures/" . $array[$x][1]);
                            unlink("client_transactions/pictures/temporary/" . $array[$x][1]);
                        }
                        
                        $sqlQuery = "DELETE FROM cart_temp";
                        $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                        header("Location:services.php");
                    }
                ?>
            </table>
            <input type="hidden" name="approved" id="approved" value="" />
        </form>
    </body>
</html>