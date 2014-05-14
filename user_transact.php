<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
            session_start();
        ?>
        <style>
            table
            {
                border: 1px solid black;
            }
            
            table th
            {
/*                background-color: #000;*/
                color: white;
                font-size: 18px;
                padding: 10px;
            }
            
            table tr td
            {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <table cellpadding='0' cellspacing='0' border="1" align='center'>
            <tr style="background-color: #555; color: white;"><td>Transaction Number</td><td>Service Type</td><td>File Name</td><td>Size</td><td>Price</td><td>Status</td><td></td></tr>
            <?php
                $sqlQuery = "SELECT transactions.*, user_info.* FROM transactions JOIN user_info WHERE transactions.user_id = user_info.user_id AND transactions.user_id='" . $_SESSION['userId'] . "'  ORDER BY id DESC";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());

                $isEmpty = 1;

                while($data = mysql_fetch_assoc($sendQuery))
                {
                    $isEmpty = 0;
                    if($data['status'] == 'finished')
                        {
                            echo "  <tr align='center' style='background-color: greenyellow;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"php_functions/transactions_info.php?trans_number=". $data['id'] . "&page=1\";'></td>
                                    </tr>";
                        }
                        else if($data['status'] == 'accepted')
                        {
                            echo "  <tr align='center' style='background-color: yellow;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"php_functions/transactions_info.php?trans_number=". $data['id'] . "&page=1\";'></td>
                                    </tr>";
                        }
                        else if($data['status'] == 'rejected')
                        {
                            echo "  <tr align='center' style='background-color: brown; color: white;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"php_functions/transactions_info.php?trans_number=". $data['id'] . "&page=1\";'></td>
                                    </tr>";
                        }
                        else if($data['status'] == 'cancelled')
                        {
                            echo "  <tr align='center' style='background-color: darkorange;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"php_functions/transactions_info.php?trans_number=". $data['id'] . "&page=1\";'></td>
                                    </tr>";
                        }
                        else
                        {
                            echo "  <tr align='center' style='background-color: khaki;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"php_functions/transactions_info.php?trans_number=". $data['id'] . "&page=1\";'></td>
                                    </tr>";
                        }
                }

                if($isEmpty == 1)
                    {
                        echo "<tr><td colspan='7' align='center'>Looks like you haven't sended a request yet. <a href='services.php' style='color: blue;'>Click here</a> to order.</td></tr>";
                    }
            ?>
        </table>
        <div align='center' style="margin: 5px;"><a href="index.php" style="color: blue;"> << go back to SMARTink</a></div>
    </body>
</html>