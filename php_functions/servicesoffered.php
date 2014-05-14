<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
            require_once("dbconn.php");
            $db = new db();
            $db->connect();
            $service = isset($_POST['serviceType']) ? $_POST['serviceType'] : "";
        ?>
    </head>
    <body>
        <?php
            if(isset($_SESSION['user']))
            {
                if($service == 1)
                {
                    serviceWithImage();
                }
            }
            else
            {
                header("Location:../login.php?redirect=1");
            }


            function serviceWithImage()
            {
                $directory = "../client_transactions/Pictures/";
                $serviceType = "Tarpaulin Printing";
                
                if($_FILES['uploadFile']['error'] == 0) // file uploading and storing
                {
                    $fileName = "TransactionNumber_" . $_SESSION['user'] . ".jpg";
                    
                    echo    "User: " . $_SESSION['user'] . "<br />
                            User id: " . $_SESSION['userId'] . "<br />
                            Service Type: " . $serviceType . "<br />
                            Path: " . $fileName . "<br />
                            Size: " . $_POST['width'] . " ft. by " . $_POST['height'] . " ft. <br />
                            Price: " . $_POST['totalPrice'] . "<br />
                            Remarks: " . $_POST['remarks'] . " <br />";
                    
                    $size = $_POST['width'] . "-" . $_POST['height'];
                    
                    $sqlQuery = "INSERT INTO cart_temp(service_type, file_name, size, price, remarks, is_ignored) VALUES('" . $serviceType . "', ' ', '" . $size . "', '" . $_POST['totalPrice'] . "', '" . $_POST['remarks'] . "', '0')";
                    $sendQuery = mysql_query($sqlQuery) or die("ERROR : at inserting table data >> " . mysql_error());
                    
                    $sqlQuery = "SELECT cart_id FROM cart_temp ORDER BY cart_id DESC LIMIT 1";
                    $sendQuery = mysql_query($sqlQuery) or die("ERROR : at selecting latest cart_id" . mysql_error());
                    
                    echo "$sqlQuery";
                    
                    while($data = mysql_fetch_assoc($sendQuery))
                    {
                        $transNumber = $data['cart_id'];
                    }
                    $fileName = "TransactionNumber" . $transNumber . "_" . $_SESSION['user'] . ".jpg";
                    
                    $sqlQuery = "UPDATE cart_temp SET file_name='" . $fileName . "' WHERE cart_id='" . $transNumber . "'";
                    $sendQuery = mysql_query($sqlQuery) or die("ERROR : at selecting latest cart_id" . mysql_error());
                    
                    move_uploaded_file($_FILES['uploadFile']['tmp_name'], $directory . $fileName);
                    
                    header("Location:../services.php");
                }
                else
                {
                    echo "Number of Errors: " . $_FILES['uploadFile']['error'];
                }
            }
        ?>
    </body>
</html>