<!DOCTYPE html>
<html>
    <head>
        <?php
//            include("template.php");
            require_once("dbconn.php");
            $db = new db();
            $db->connect();

            $mode = isset($_GET['mode']) ? $_GET['mode'] : (isset($_POST['mode']) ? $_POST['mode'] : "");
            $cart_id = isset($_GET['cart_id']) ? $_GET['cart_id'] : (isset($_POST['cart_id']) ? $_POST['cart_id'] : "");

            if($mode == "" || $cart_id == "")
            {
                header("Location:../services.php");
            }

        ?>
        <link type="text/css" rel="stylesheet" href="../css/cart_temp_extra.css">
        <script src="../jquery-2.0.3.js"></script>
        <script src="../services.js"></script>
        <style>
            
        </style>
        <title>SMARTink</title>
    </head>
    <body>
        <div id='bodyContent'>
        <?php
            $sqlQuery = "SELECT service_type FROM cart_temp WHERE cart_id='" . $cart_id . "'";
            $sendQuery = mysql_query($sqlQuery) or die("ERROR: looking at service_type >> " . mysql_error());
            
            while($data = mysql_fetch_assoc($sendQuery))
            {
                if($mode == "edit" && $data['service_type'] == "Tarpaulin Printing")
                {
                    pictureEdit($cart_id, $mode);
                    tarpEditCart($cart_id, $mode);
                }
                else if($mode == "edit2" && $data['service_type'] == "Tarpaulin Printing")
                {
                    tarpEditQuery($cart_id);
                }
                else if($mode == "edit" && $data['service_type'] == "Shirt Printing")
                {
//                    pictureEdit($cart_id, $mode);
                    shirtEditCart($cart_id);
                }
                else if($mode == "edit2" && $data['service_type'] == "Shirt Printing")
                {
                    shirtEditQuery($cart_id);
                }
                else if($mode == "editPix")
                {
                    pictureEdit2($cart_id);
                }
                else if($mode == "delete")
                {
                    deleteQuery($cart_id);
                }
            }

            function pictureEdit($cart_id, $mode)
            {
                echo "  <form action='cart_temp_extra.php' method='post' name='replacePixForm' id='replacePixForm' enctype='multipart/form-data'>
                            <div id='pixForm'>
                                Replace image: <input type='file' accept='image/*' name='imageFile' id='imageFile' required> <input type='button' value='replace' onclick=\"confirmAction('Old picture will be deleted. Continue?','1', '')\">
                            </div>
                            <input type='hidden' name='mode' value='editPix'>
                            <input type='hidden' name='cart_id' value='" . $cart_id . "'>
                        </form>";
            }

            function pictureEdit2($cart_id)
            {
                $path = "../client_transactions/pictures/temporary/";
                
                $sqlQuery = "SELECT file_name FROM cart_temp WHERE cart_id='" . $cart_id . "'";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: at fetching file_name from cart_temp >> " . mysql_error());
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    move_uploaded_file($_FILES['imageFile']['tmp_name'], $path . $data['file_name']);
                }
                header("Location:cart_temp_extra.php?cart_id=" . $cart_id . "&mode=edit");
            }

            function tarpEditCart($cart_id, $mode)
            {
                $sqlQuery = "SELECT * FROM cart_temp WHERE cart_id='" . $cart_id . "'";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: at editCart >> " . mysql_error());
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    $size = explode("-", $data['size']);
                    echo "  <div align='center'>
                                <h2 align='left'>Edit - " . $data['service_type'] . "</h2><hr><br>
                                <form action='cart_temp_extra.php' method='post' name='editForm' id='editForm'>
                                    <div id='image'>
                                        <div id='imgloc' style='background-image: url(\"../client_transactions/pictures/temporary/" . $data['file_name'] . "\")'></div>
                                    </div>
                                    <div id='sizes'>
                                        Width: <span id='shownW'>" . $size[0] . "</span>ft. <input type='range' min='1' max='12' value='" . $size[0] . "' name='width' id='width' onchange=\"currentPrice('width', 'height', '20', 'price','shownW', 'shownH', 'pieces')\"> &nbsp;
                                        Height: <span id='shownH'>" . $size[1] . "</span>ft. <input type='range' min='1' max='30' value='" . $size[1] . "' name='height' id='height' onchange=\"currentPrice('width', 'height', '20', 'price','shownW', 'shownH', 'pieces')\"> &nbsp;
                                        Pieces: <input type='number' min='1' max='999' value='1' name='pieces' id='pieces' onchange=\"currentPrice('width', 'height', '20', 'price','shownW', 'shownH', 'pieces')\"> &nbsp;
                                        Prize: <b>Php <span id='price'>" . $data['price'] . "</span></b>
                                    </div>
                                    <div id='divRemarks'>
                                        <div>Remarks:</div>
                                        <textarea name='remarks' id='remarks' required placeholder='Put your remarks here. Also include special details like when do you need it.(if you have time requirements only)'>" . $data['remarks'] . "</textarea>
                                    </div>
                                    <input type='submit' value='save changes'>
                                    <input type='hidden' name='mode' value='edit2'>
                                    <input type='hidden' name='cart_id' value='" . $cart_id . "'>
                                    <input type='hidden' name='totalPrice' id='totalPrice' value='" . $data['price'] . "'>
                                </form>
                            </div>";
                }
            }

            function tarpEditQuery($cart_id)
            {
                $sqlQuery = "UPDATE cart_temp SET size='" . $_POST['width'] . "-" . $_POST['height'] . "-" . $_POST['pieces'] . "', price='" . $_POST['totalPrice'] . "', remarks='" . $_POST['remarks'] . "' WHERE cart_id='" . $cart_id . "'";
//                echo $sqlQuery;
                mysql_query($sqlQuery) or die("ERROR: at updating cart_temp >> " . mysql_error());
                header("Location:../services.php");
            }

            function shirtEditCart($cart_id)
            {
                $typeOfShirt[0] = array("rn", "Round Neck"); 
                $typeOfShirt[1] = array("ps", "Polo Shirt"); 
                
                $sizeOfShirt[0] = array("small", "Small");
                $sizeOfShirt[1] = array("medium", "Medium");
                $sizeOfShirt[2] = array("large", "Large");
                $sizeOfShirt[3] = array("xl", "X Large");
                $sizeOfShirt[4] = array("xxl", "XX Large");
                $sizeOfShirt[5] = array("xxxl", "XXX Large");
                
                $sqlQuery = "SELECT * FROM cart_temp WHERE cart_id='" . $cart_id . "'";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: at editCart >> " . mysql_error());
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    $size = explode("-", $data['size']);
                    echo "  <div align='center'>
                                <h2 align='left'>Edit - " . $data['service_type'] . "</h2><hr><br>
                                <form action='cart_temp_extra.php' method='post' name='editForm' id='editForm'>
                                    <div id='image'>
                                        <div name='imgloc' id='imgloc'style='background-image:url(";
                    if($size[0] == "Round Neck")
                    {
                        echo "../images/shirtRound.jpg";
                    }
                    else if($size[0] == "Polo Shirt")
                    {
                        echo "../images/shirtPolo.jpg";
                    }
                    echo")'><div id='logo' style='background-image: url(\"../client_transactions/pictures/temporary/" . $data['file_name'] . "\")'></div></div>
                                    </div>
                                    <div id='sizes'>
                                        Shirt Type: <select name='shirtType' id='shirtType' onchange='editLoadShirt(\"imgloc\", \"shirtType\"); shirtPrice(\"shirtType\", \"shirtSize\", \"price\", \"totalPrice\", \"pieces\");'>";
                    for($x = 0; $x < count($typeOfShirt); $x++)
                    {
                        if($typeOfShirt[$x][1] == $size[0])
                        {
                            echo "                          <option value='" . $typeOfShirt[$x][0] . "' selected>" . $typeOfShirt[$x][1] . "</option>";
                        }
                        else
                        {
                            echo "                          <option value='" . $typeOfShirt[$x][0] . "'>" . $typeOfShirt[$x][1] . "</option>";
                        }
                    }
                    echo "                          </select> 
                                        Size: <select name='shirtSize' id='shirtSize' onchange='shirtPrice(\"shirtType\", \"shirtSize\", \"price\", \"totalPrice\", \"pieces\");'>";
                    for($x = 0; $x < count($sizeOfShirt); $x++)
                    {
                        if($sizeOfShirt[$x][0] == $size[1])
                        {
                            echo "                          <option value='" . $sizeOfShirt[$x][0] . "' selected>" . $sizeOfShirt[$x][1] . "</option>";
                        }
                        else
                        {
                            echo "                          <option value='" . $sizeOfShirt[$x][0] . "'>" . $sizeOfShirt[$x][1] . "</option>";
                        }
                    }                        
                    echo "              </select>
                                        Piece(s):<input type='number' name='pieces' id='pieces' value='" . $size[2] . "' min='1' max='500' onchange='shirtPrice(\"shirtType\", \"shirtSize\", \"price\", \"totalPrice\", \"pieces\");'> &nbsp;
                                        Prize: <b>Php <span id='price'>" . $data['price'] . "</span></b>
                                    </div>
                                    <div id='divRemarks'>
                                        <div>Remarks:</div>
                                        <textarea name='remarks' id='remarks' required placeholder='Put your remarks here. Also include special details like when do you need it.(if you have time requirements only)'>" . $data['remarks'] . "</textarea>
                                    </div>
                                    <input type='submit' value='save changes'>
                                    <input type='hidden' name='mode' value='edit2'>
                                    <input type='hidden' name='cart_id' value='" . $cart_id . "'>
                                    <input type='hidden' name='totalPrice' id='totalPrice' value='" . $data['price'] . "'>
                                </form>
                            </div>";
                }
            }

            function shirtEditQuery($cart_id)
            {
                if($_POST['shirtType'] == "rn")
                {
                    $shirtType = "Round Neck";
                }
                else if($_POST['shirtType'] == "ps")
                {
                    $shirtType = "Polo Shirt";
                }
                
                $sqlQuery = "UPDATE cart_temp SET size='" . $shirtType . "-" . $_POST['shirtSize'] . "-" . $_POST['pieces'] . "', price='" . $_POST['totalPrice'] . "', remarks='" . addslashes($_POST['remarks']) . "' WHERE cart_id='" . $_POST['cart_id'] . "'";
                
                mysql_query($sqlQuery) or die("ERROR: at updating cart_temp >> " . mysql_error());
                header("Location:../services.php");
            }

            function deleteQuery($cart_id)
            {
                $sqlQuery = "SELECT file_name FROM cart_temp WHERE cart_id='" . $cart_id . "'";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: at selecting file_name from cart_temp(delete) >> " . mysql_error());
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    unlink("../client_transacions/pictures/temporary/" . $data['file_name']);
                }
                
                $sqlQuery = "DELETE FROM cart_temp where cart_id='" . $cart_id . "'";
                mysql_query($sqlQuery) or die("ERROR: at deleting data from cart_temp >> " . mysql_error());
                header("Location:../services.php");
            }
        ?>
        </div>
    </body>
</html>