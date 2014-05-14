<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once("dbconn.php");
            $db = new db();
            $db->connect();
            session_start();
        ?>
        <title>SMARTink</title>
    </head>
    <body>
        <?php
//            echo    $_POST['totalPrice'] . "<br>" .
//                    $_POST['width'] . "<br>" .
//                    $_POST['height'] . "<br>" .
//                    $_POST['remarks'] . "<br>" .
//                    $_POST['serviceType'] . "<br>";

            $fileName = $_SESSION['user'] . "_" . rand(10000000, 99999999) . "-" . rand(10000000, 99999999) . ".jpg";

            if($_POST['serviceType'] == 1)
            {
                $service = "Tarpaulin Printing";
                $sqlQuery = "INSERT INTO cart_temp(service_type, file_name, size, price, remarks, is_ignored) VALUES('" . $service . "', '" . $fileName . "', '" . $_POST['width'] ."-" . $_POST['height'] . "-" . $_POST['pieces'] . "', '" . $_POST['totalPrice'] . "', '" . $_POST['remarks'] . "', '0')";
                mysql_query($sqlQuery) or die("ERROR: at inserting value into cart_temp >> " . mysql_error());
                
                copy("../client_transactions/" . $_SESSION['user'] . "sample.jpg", "../client_transactions/pictures/temporary/" . $fileName);
            }
            else if($_POST['serviceType'] == 2)
            {
                if($_POST['shirtType'] == 'rn')
                {
                    $shirtType = "Round Neck";
                }
                else if($_POST['shirtType'] == 'ps')
                {
                    $shirtType = "Polo Shirt";
                }
                
                $service = "Shirt Printing";
                $sqlQuery = "INSERT INTO cart_temp(service_type, file_name, size, price, remarks, is_ignored) VALUES('" . $service . "', '" . $fileName . "', '" . $shirtType . "-" . $_POST['shirtSize'] . "-" . $_POST['pieces'] . "', '" . $_POST['totalPrice'] . "', '" . $_POST['remarks'] . "', '0')";
                mysql_query($sqlQuery) or die("ERROR: at inserting value into cart_temp >> " . mysql_error());
                
                if($_POST['selectedDesign'] != "") // means that user selects to the default designs
                {
                    copy("../images/shirtLogos/" . $_POST['selectedDesign'], "../client_transactions/pictures/temporary/" . $fileName);
                }
                else
                {
                    copy("../client_transactions/" . $_SESSION['user'] . "sample.jpg", "../client_transactions/pictures/temporary/" . $fileName);
                }
            }
            else if($_POST['serviceType'] == 3)
            {
                $service = "Calling Card";
                $sqlQuery = "INSERT INTO cart_temp(service_type, file_name, size, price, remarks, is_ignored) VALUES('" . $service . "', '" . $fileName . "', '" . $_POST['pieces'] . "-" . $_POST['cardSize'] . "', '" . $_POST['totalPrice'] . "', '" . $_POST['remarks'] . "', '0')";
                mysql_query($sqlQuery) or die("ERROR: at inserting value into cart_temp >> " . mysql_error());
                
                copy("../client_transactions/" . $_SESSION['user'] . "sample.jpg", "../client_transactions/pictures/temporary/" . $fileName);
            }

            echo $sqlQuery;

            header("Location:../services.php");
        ?>
    </body>
</html>