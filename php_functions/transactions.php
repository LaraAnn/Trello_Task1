<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once("dbconn.php");
            $db = new db();
            $db->connect();
        
            $field = isset($_POST['param1']) ? $_POST['param1'] : "";
            $stringValue = isset($_POST['param2']) ? $_POST['param2'] : "";

//            $fields[0] = array("id", "Transaction ID");
            $fields[0] = array("username", "User Name");
            $fields[1] = array("service_type", "Service Type");
            $fields[2] = array("status", "Status");
        ?>
        <script src="jquery-2.0.3.js"></script>
<!--        <script src="transactions.js"></script>-->
        <style>
            *
            {
/*                font-family: "calibri";*/
            }
            
            table
            {
                border: 1px solid black;
            }
            
            table th
            {
                background-color: #000;
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
    <body onload="document.getElementById('param1').value = document.getElementById('searchParameter').value;">
        <form method="post" action="transactions.php" name="searchResult">
            <table cellspacing="0" cellpadding="0" border="1" align='center'>
                <tr><th colspan="8">Transactions</th></tr>
                <tr align="center">
                    <td colspan="8">
                        Search By: 
                        <select name="searchParameter" id="searchParameter" onchange="document.getElementById('param1').value = document.getElementById('searchParameter').value;" autofocus>
<!--                            <option value="">--SELECT--</option>-->
                        <?php    
                            for($x = 0; $x < count($fields); $x++)
                            {
                                if($field == $fields[$x][0])
                                {
                                    echo "<option value='" . $fields[$x][0] . "' selected>" . $fields[$x][1] . "</option>";
                                }
                                else
                                {
                                        echo "<option value='" . $fields[$x][0] . "'>" . $fields[$x][1] . "</option>";
                                }
                            }
                        ?>
                        </select>
                        <input type="text" name="searchString" id="searchString" value="<?php echo $stringValue;?>" onchange="document.getElementById('param2').value = document.getElementById('searchString').value;">
                        <input type="submit" value="Search">
                    </td>
                </tr>
                <tr style="background-color: #555; color: white;"><td>Transaction Number</td><td>Username</td><td>Service Type</td><td>File Name</td><td>Size</td><td>Price</td><td>Status</td><td></td></tr>
                
                <?php
                    if($field == "")
                    {
                        $sqlQuery = "SELECT transactions.*, user_info.* FROM transactions JOIN user_info WHERE transactions.user_id = user_info.user_id ORDER BY id DESC";
                    }
                    else
                    {
                        $sqlQuery = "SELECT transactions.*, user_info.* FROM transactions JOIN user_info WHERE transactions.user_id = user_info.user_id AND " . $field . " LIKE '%" . $stringValue . "%' ORDER BY id DESC";
                    }
                    $sendQuery = mysql_query($sqlQuery) or die("ERROR: at view all >>" . mysql_error());
                    
//                    echo $sqlQuery;
                    
//                    $isEmpty = 1;

                    while($data = mysql_fetch_assoc($sendQuery))
                    {
//                        $isEmpty = 0;
                        if($data['status'] == 'finished')
                        {
                            echo "  <tr align='center' style='background-color: greenyellow;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['username'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"transactions_info.php?trans_number=". $data['id'] . "\";'></td>
                                    </tr>";
                        }
                        else if($data['status'] == 'accepted')
                        {
                            echo "  <tr align='center' style='background-color: yellow;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['username'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"transactions_info.php?trans_number=". $data['id'] . "\";'></td>
                                    </tr>";
                        }
                        else if($data['status'] == 'rejected')
                        {
                            echo "  <tr align='center' style='background-color: brown; color: white;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['username'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"transactions_info.php?trans_number=". $data['id'] . "\";'></td>
                                    </tr>";
                        }
                        else if($data['status'] == 'cancelled')
                        {
                            echo "  <tr align='center' style='background-color: darkorange;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['username'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"transactions_info.php?trans_number=". $data['id'] . "&page=1\";'></td>
                                    </tr>";
                        }
                        else
                        {
                            echo "  <tr align='center' style='background-color: khaki;'>
                                        <td>" . $data['id'] . "</td>
                                        <td>" . $data['username'] . "</td>
                                        <td>" . $data['service_type'] . "</td>
                                        <td>" . $data['file_name'] . "</td>
                                        <td>" . $data['size'] . "</td>
                                        <td>" . $data['price'] . "</td>
                                        <td>" . $data['status'] . "</td>
                                        <td><input type='button' value='view' onclick='window.location.href = \"transactions_info.php?trans_number=". $data['id'] . "\";'></td>
                                    </tr>";
                        }
                    }
                ?>
                
            </table>
            <input type="hidden" name="param1" id="param1" value="<?php echo $field;?>">
            <input type="hidden" name="param2" id="param2" value="<?php echo $stringValue;?>">
        </form>
        <div align='center' style="margin: 5px;"><a href="../index.php" style="color: blue;"> << go back to SMARTink</a></div>
    </body>
</html>