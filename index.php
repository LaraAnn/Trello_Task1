<!doctype html>
<html>
    <head>
		<?php
			include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
		?>
        <link rel="stylesheet" href="css/index.css" type="text/css" />
        <link rel="stylesheet" href="css/template_style.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/editor.css" />
        <link rel="stylesheet" type="text/css" href="php_functions/jquery_styles.php" />
        <script src="index.js"> </script>
        <script src="jquery-2.0.3.js"> </script>
        <script src="functions.js"></script>
        <title> SMARTink </title>
    </head>
    <body onload="initializE(); loadStyle();">
        
        <?php
            templateHeader();
		?>
            
        <div id="bodyContent">
            <div id="events"> 
                <?php
                    if(isset($_SESSION['admin']))
                    {
                        echo "<editor align='center'><input type='button' value='edit events' onclick=\"changePage('php_functions/CMSedit.php?part=1')\" /></editor>";
                    }

                    $sqlQueryString = "SELECT * FROM events ORDER BY id_event DESC";
                    $sendQuery = mysql_query($sqlQueryString) or die(mysql_error());
                    while($data = mysql_fetch_assoc($sendQuery))
                    {
                        echo "  <div>";
                        echo "      <h3>" . $data['event_title'] . "</h3>";
                        echo "      <p><br />" . $data['event_desc'] . "</p>";
                        echo "  </div>";
                        echo "  <hr />";
                    }
                ?>
            </div>
            
            <div id="slider">
                <div id="sliderBtns">
                    <input type="radio" id="sliderRadio1" name="sliderRadio" value="1" onclick="radioSlide()" checked/>
                    <input type="radio" id="sliderRadio2" name="sliderRadio" value="2" onclick="radioSlide()" />
                    <input type="radio" id="sliderRadio3" name="sliderRadio" value="3" onclick="radioSlide()" />
                </div>
                <?php
                    if(isset($_SESSION['admin']))
                    {
                        echo "<editor align='center'><input type='button' value='edit slider' onclick=\"changePage('php_functions/CMSedit.php?part=6')\" /></editor>";
                    }
                ?>
                <div id="overflow">
                    <?php
                        $sqlQueryString = "SELECT * FROM slider_info";
                        $sendQuery = mysql_query($sqlQueryString) or die(mysql_error());
                        $slideNum = 1;
                        while($data = mysql_fetch_assoc($sendQuery))
                        {   
                            echo "  <div class='slide'>";
                            echo "      <div id='sliderImage' class='s" . $slideNum . "'>";
                            echo "          <input type='hidden' id='imgsrc" . $slideNum . "' value='" . $data['slider_pic_source'] . "' />";
                            echo "          <div id='sliderDesc' align='center'>";
                            echo "              <div align='left'>";
                            echo "                  <h2>" . $data['slider_header'] . "</h2>";
                            echo "                  <p><br/>" . $data['slider_desc'] . "</p>";
                            echo "              </div>";
                            echo "          </div>";
                            echo "      </div>";
                            echo "  </div>";
                            $slideNum += 1;
                        }
                    ?>
                </div>    
            </div>
        </div>
        
        <?php
			templateFooter();
		?>
    </body>
</html>