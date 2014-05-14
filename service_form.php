<!DOCTYPE html>
<html>
    <head>
        <?php
            include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();

            $type = isset($_POST['serviceType']) ? $_POST['serviceType'] : "";
            $path = "client_transactions/";
            
            if(isset($_FILES['imageFile']))
            {
                if($_POST['serviceType'] == 1 || $_POST['serviceType'] == 2 || $_POST['serviceType'] == 3)
                {
                    move_uploaded_file($_FILES['imageFile']['tmp_name'], $path . $_SESSION['user'] . "sample.jpg");
                }
            }
        ?>
        <title>SMARTink</title>
        <link type="text/css" rel="stylesheet" href="css/template_style.css">
        <link type="text/css" rel="stylesheet" href="css/service_form.css">
        <link type="text/css" rel="stylesheet" href="css/editor.css">
        <script src="jquery-2.0.3.js"></script>
        <script src="services.js"></script>
        <style>
            #form > form > div > #imagePreview
            {
                background-image: url('<?php echo $path . $_SESSION['user'] . "sample.jpg";?>');
            }
            
            #form > form > div > #imagePreview > #logo
            {
                background-image: url('<?php if(file_exists($path . $_SESSION['user'] . "sample.jpg")){echo $path . $_SESSION['user'] . "sample.jpg";}else{echo "images/shirtLogos/design1.jpg";}?>');
            }
        </style>
    </head>
    <body>
        <?php
            templateHeader();
        ?>
        <div id="bodyContent">
            <div id="form">
                <?php
                    if($type == "")
                    {
                        header("Location:services.php");
                    }
                    else if($type == 0)
                    {
                        echo    $_POST['totalPrice'] . "<br>" .
                                $_POST['width'] . "<br>" .
                                $_POST['height'] . "<br>" .
                                $_POST['remarks'];
                    }
                    else if($type == 1)
                    {
                        echo "<h2>Tarpaulin Printing</h2><hr><br>";
                        tarpPrint($type);
                    }
                    else if($type == 2)
                    {
                        echo "<h2>Shirt Printing</h2><hr><br>";
                        shirtPrint($type);
                    }
                    else if($type == 3)
                    {
                        echo "<h2>Calling Card</h2><hr><br>";
                        cardPrint($type);
                    }

                    function tarpPrint($type)
                    {
                        echo "  <form action=\"service_form.php\" method=\"post\" name=\"replacePixForm\" enctype=\"multipart/form-data\">
                                    <div id=\"pixForm\">
                                        Replace image: <input type=\"file\" accept=\"image/*\" name=\"imageFile\" required> <input type=\"submit\" value=\"replace\">
                                    </div>
                                    <input type=\"hidden\" name=\"serviceType\" value=\"" . $type . "\">
                                    <input type=\"hidden\" name=\"replaceImg\" value=\"1\">
                                </form>";
                                
                        echo "  <form action=\"php_functions/send_request.php\" method=\"post\" name=\"requestForm\">
                                    <div align=\"center\">
                                        <div id=\"imagePreview\"></div>
                                        <div id=\"details\">
                                            Width: <span id=\"shownW\">2</span>ft. <input type=\"range\" min=\"1\" max=\"12\" value=\"2\" name=\"width\" id=\"width\" onchange=\"currentPrice('width', 'height', '20', 'price','shownW', 'shownH', 'pieces')\"> &nbsp;
                                            Height: <span id=\"shownH\">3</span>ft. <input type=\"range\" min=\"1\" max=\"30\" value=\"3\" name=\"height\" id=\"height\" onchange=\"currentPrice('width', 'height', '20', 'price','shownW', 'shownH', 'pieces')\"> &nbsp;
                                            Piece(s): <input type='number' min='1' max='999' value='1' name='pieces' id='pieces' onchange=\"currentPrice('width', 'height', '20', 'price','shownW', 'shownH', 'pieces')\">
                                            Prize: <b>Php <span id=\"price\">120</span></b>
                                        </div>
                                        <div id=\"remarks\">
                                            <div>Remarks:</div>
                                            <textarea class=\"remarks\" name=\"remarks\" required placeholder='Put your remarks here. Also include special details like when do you need it.(if you have time requirements only)'></textarea>
                                        </div>
                                        <div id=\"addToCart\"><input type=\"submit\" value=\"add to cart\"></div>
                                    </div>
                                    <input type=\"hidden\" name=\"serviceType\" value=\"1\">
                                    <input type=\"hidden\" name=\"totalPrice\" id='totalPrice' value=\"120\">
                                </form>";
                    }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                    function shirtPrint($type)
                    {
                        $path = "images/";
                        $imgType = "";
                        
                        $typeArr[0] = array("rn", "Round Neck");
                        $typeArr[1] = array("ps", "Polo Shirt");
//                        $typeArr[2] = array("cs", "Couple Shirt");
                        
                        $file = scandir("images/shirtLogos/");
                        
                        $shirtType = isset($_POST['shirtType']) ? $_POST['shirtType'] : "";
                        
//                        echo $_POST['shirtType'];
                        
                        if($shirtType == 'rn')
                        {
                            $imgType = "shirtRound.jpg";
                        }
                        else if($shirtType == 'ps')
                        {
                            $imgType = "shirtPolo.jpg";
                        }
                        
                        echo "  <form action=\"service_form.php\" method=\"post\" name=\"replacePixForm\" enctype=\"multipart/form-data\">
                                    <div id=\"pixForm\">
                                        Replace image: <input type=\"file\" accept=\"image/*\" name=\"imageFile\" required> <input type=\"submit\" value=\"replace\" onclick='document.getElementById(\"selectedDesign\").value = \"\";'>
                                    </div>
                                    <input type=\"hidden\" name=\"serviceType\" value=\"" . $type . "\">
                                    <input type=\"hidden\" name=\"replaceImg\" value=\"1\">
                                    <input type=\"hidden\" name=\"shirtType\" value=\"" . $shirtType . "\">
                                </form>";
                        
                        echo "  <form action=\"php_functions/send_request.php\" method=\"post\" name=\"requestForm\">
                                    <div align='center'>
                                        <div id='imagePreview' style='background-image: url(" . $path . $imgType . ");'>
                                            <div id='logo'></div>
                                        </div>
                                        <div id='overflow'>
                                            <div id='imageThumbnails' style='width: " . ((count($file) - 2) * 200) . "px'>";    
                        for($x = 0; $x < count($file) - 2; $x++)
                        {
                            echo "              <div id='thumbnail' style='background-image:url(images/shirtLogos/" . $file[$x + 2] . ");' onclick='loadImage(\"logo\", \"images/shirtLogos/" . $file[$x + 2] . "\", \"" . $file[$x + 2] . "\");'>
                                                </div>";
                        }
                        
                        echo "              </div>
                                        </div>
                                        <div id='details'>
                                            Shirt Type: <select name='shirtType' id='shirtType' onchange='loadShirt(\"imagePreview\", \"shirtType\"); shirtPrice(\"shirtType\", \"shirtSize\", \"price\", \"totalPrice\", \"pieces\");'>";
                        for($x = 0; $x < count($typeArr); $x++)
                        {
                            if($typeArr[$x][0] == $_POST['shirtType'])
                            {
                                echo "              <option value='" . $typeArr[$x][0] . "' selected>" . $typeArr[$x][1] . "</option>";
                            }
                            else
                            {
                                echo "              <option value='" . $typeArr[$x][0] . "'>" . $typeArr[$x][1] . "</option>";
                            }
                        }
                        echo "              </select>
                                            Size: <select name='shirtSize' id='shirtSize' onchange='shirtPrice(\"shirtType\", \"shirtSize\", \"price\", \"totalPrice\", \"pieces\");'>
                                                <option value='small'>Small</option>
                                                <option value='medium' selected>Medium</option>
                                                <option value='large'>Large</option>
                                                <option value='xl'>X Large</option>
                                                <option value='xxl'>XX Large</option>
                                                <option value='xxxl'>XXX Large</option>
                                            </select>
                                            Piece(s): <input type='number' min='1' value='1' name='pieces' id='pieces' max='500' onchange='shirtPrice(\"shirtType\", \"shirtSize\", \"price\", \"totalPrice\", \"pieces\");' required>
                                            &nbsp; Prize: <b>Php <span id='price'>";
                        if($_POST['shirtType'] == 'rn')
                        {
                            $totalPrice = 280;
                            echo "280";
                        }
                        else if($_POST['shirtType'] == 'ps')
                        {
                            echo "330"; 
                            $totalPrice = 330;
                        }
                        
                        echo "</span></b>
                                        </div>
                                        <div id=\"remarks\">
                                            <div>Remarks:</div>
                                            <textarea class=\"remarks\" name=\"remarks\" required placeholder='Put your remarks here. Also include special details like when do you need it.(if you have time requirements only)'></textarea>
                                        </div>
                                        <div id=\"addToCart\"><input type=\"submit\" value=\"add to cart\"></div>
                                    </div>
                                    <input type='hidden' name='serviceType' id='serviceType' value='2'>
                                    <input type='hidden' name='selectedDesign' id='selectedDesign' value=''>
                                    <input type='hidden' name='totalPrice' id='totalPrice' value='" . $totalPrice . "'>
                                </form>";
                    }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                    function cardPrint($type)
                    {
                        $cardSize[0] = array('normal', 'Normal Business Card (3.5 inches by 2 inches)');
                        $cardSize[1] = array('folded', 'Folded Business Card (3.75 inches by 2.25 inches)');
                        $cardSize[2] = array('id1', 'ID-1 (3.370 inches by 2.125 inches)');
                        
                        echo "  <form action=\"service_form.php\" method=\"post\" name=\"replacePixForm\" enctype=\"multipart/form-data\">
                                    <div id=\"pixForm\">
                                        Replace image: <input type=\"file\" accept=\"image/*\" name=\"imageFile\" required> <input type=\"submit\" value=\"replace\">
                                    </div>
                                    <input type=\"hidden\" name=\"serviceType\" value=\"" . $type . "\">
                                    <input type=\"hidden\" name=\"replaceImg\" value=\"1\">
                                </form>";
                                
                        echo "  <form action=\"php_functions/send_request.php\" method=\"post\" name=\"requestForm\">
                                    <div align=\"center\">
                                        <div id=\"imagePreview\"></div>
                                        <div id=\"details\">
                                            Piece(s): <input type='number' min='100' max='10000' value='100' name='pieces' id='pieces' onchange=\"cardPrice('pieces', 'price')\">
                                            Card Size: <select name='cardSize' id='cardSize'>";
                        
                        for($x = 0;$x < count($cardSize); $x++)
                        {
                            if($cardSize[$x][0] == $_POST['cardSize'])
                            {
                                echo "              <option value='" . $cardSize[$x][0] . "' selected>" . $cardSize[$x][1] . "</option>";
                            }
                            else
                            {
                                echo "              <option value='" . $cardSize[$x][0] . "'>" . $cardSize[$x][1] . "</option>";
                            }
                        }
                        
                        echo "              </select>
                                            Price: <b>Php <span id=\"price\">300</span></b>
                                        </div>
                                        <div id=\"remarks\">
                                            <div>Remarks:</div>
                                            <textarea class=\"remarks\" name=\"remarks\" required placeholder='Put your basic information needed for a business card. (Example: Name, E-mail, Company Name, Contact Details)'></textarea>
                                        </div>
                                        <div id=\"addToCart\"><input type=\"submit\" value=\"add to cart\"></div>
                                    </div>
                                    <input type=\"hidden\" name=\"serviceType\" value=\"3\">
                                    <input type=\"hidden\" name=\"totalPrice\" id='totalPrice' value=\"300\">
                                </form>";
                    }
                ?>
            </div>
        </div>
        <?php
            templateFooter();
        ?>
    </body>
</html>