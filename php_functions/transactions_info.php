<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once("dbconn.php");
            $db = new db();
            $db->connect();
            $request = isset($_POST['status']) ? $_POST['status'] : "";

            session_start();
        ?>
        <title></title>
        
        <style>
            *
            {
                margin: 0px;
                padding: 0px;
            }
            
            table th
            {
                background-color: black;
                color: white;
                font-size: 18px;
                padding: 5px;
            }
            table tr td
            {
                padding: 5px;
            }
            
            textarea
            {
                
                width: 100%;
                height: 100px;
            }
        </style>
    </head>
    <body>
        <form method="post" action="transactions_info.php" name="viewInfo">
        <?php
            if($request != "")
            {
                RequestQuery();
            }
            else
            {
                viewInfo();
            }
            
            function viewInfo()
            {
                $sqlQuery = "SELECT * FROM transactions, user_info WHERE transactions.id = '" . $_GET['trans_number'] . "' AND transactions.user_id = user_info.user_id";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: WRONG QUERY >> " . mysql_error());
    
                echo "  <div align='center'>
                            <table cellpadding='0' cellspacing='0' border='0'>
                                <tr><th colspan='2'>Transaction Info</th></tr>";
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "      <tr>
                                    <td valign='top'>
                                        User: " . $data['username'] . "<br>
                                        Service Type: " . $data['service_type'] . "<br>
                                        Size: " . $data['size'] . "<br>
                                        Price: " . $data['price'] . "
                                    </td>
                                    <td>
                                        <img src='../client_transactions/pictures/" . $data['file_name'] . "' height='300px'>
                                        <div align='center'>" . $data['file_name'] . "</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        Remarks:
                                        <div align='center'><textarea readonly>" . $data['remarks'] . "</textarea></div>
                                    </td>
                                </tr>";
                    if($data['status'] == 'rejected' && isset($_SESSION['user']) || $data['status'] == 'cancelled' && isset($_SESSION['user']))
                    {
                        //none
                    }
                    else if(isset($_SESSION['user']) && $data['status'] != 'finished')
                    {
                        echo "          <tr><td colspan='2' align='right'><input type='submit' value='cancel' onclick='document.getElementById(\"status\").value=\"cancelled\"'></td></tr>";
                    }
                    else if($data['status'] == 'pending' && isset($_SESSION['admin']))
                    {
                        echo "          <tr><td colspan='2' align='right'><input type='submit' value='accept' onclick='document.getElementById(\"status\").value=\"accepted\"'> <input type='submit' value='reject' onclick='document.getElementById(\"status\").value=\"rejected\"'></td></tr>";
                    }
                    else if($data['status'] == 'accepted' && isset($_SESSION['admin']))
                    {
                        echo "          <tr><td colspan='2' align='right'><input type='submit' value='finish' onclick='document.getElementById(\"status\").value=\"finished\"'> <input type='submit' value='reject' onclick='document.getElementById(\"status\").value=\"rejected\"'></td></tr>";
                    }
                }
                
                
                echo "            </table>
                            <input type='hidden' name='status' id='status' value='pending'>
                            <input type='hidden' name='trans_id' id='trans_id' value='" . $_GET['trans_number'] . "'>
                        </div>";
            }

            function RequestQuery()
            {
                $sqlQuery = "UPDATE transactions SET status='" . $_POST['status'] . "' WHERE id='" . $_POST['trans_id'] . "'";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: IN STATUS CHANGING!! >> " . mysql_error());
                if(isset($_SESSION['user']))
                {
                    header("Location:../user_transact.php");
                }
                else
                {
                    header("Location:transactions.php");
                }
            }
        ?>
        </form>
    </body>
</html>