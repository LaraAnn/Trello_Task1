<!doctype html>
<html>
    <head>
		<?php
			include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
		?>
        <link rel="stylesheet" type="text/css" href="css/template_style.css" />
        <link rel="stylesheet" type="text/css" href="css/about.css" />
        <link rel="stylesheet" type="text/css" href="css/editor.css" />
        <link rel="stylesheet" type="text/css" href="php_functions/jquery_styles.php" />
        <script src="functions.js"></script>
        <script src="jquery-2.0.3.js"></script>
        <title>SMARTink</title>
    </head>
    <body>
        <?php
			templateHeader();
		?>
        
        <div id="bodyContent">
            <div id="insideContent">
                <?php
                    if(isset($_SESSION['admin']))
                    {
                        echo "<editor align='center'><input type='button' value='edit about' onclick=\"changePage('php_functions/CMSedit.php?part=3')\" /></editor>";
                    }
                ?>
                <h1>About</h1>
                <hr /><br />
                <?php
                    $sqlQuery = "SELECT * FROM about_info";
                    $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                    
                    
                    while($data = mysql_fetch_assoc($sendQuery))
                    {
                        if($data['about_title'] == 'About')
                        {
                            echo "  <p>" . $data['about_desc'] . "</p>";
                            echo "  <br /><hr /><br />";
                        }
                        else if($data['about_title'] == 'History')
                        {
                            echo "  <h2>" . $data['about_title'] . "</h2>";
                            echo "  <p>" . $data['about_desc'] . "</p>";
                            echo "  <br /><hr /><br />";
                            echo "  <div id='missionVisionContent'>";
                            echo "      <h2>Mission and Vision</h2>";
                            echo "      <br />";
                        }
                        else if($data['about_title'] == 'Mission')
                        {
                            echo "      <div>";
                            echo "          <h2>" . $data['about_title'] . "</h2>";
                            echo "          <p>" . $data['about_desc'] . "</p>";
                            echo "      </div>";
                        }
                        else if($data['about_title'] == 'Vision')
                        {
                            echo "      <div>";
                            echo "          <h2>" . $data['about_title'] . "</h2>";
                            echo "          <p>" . $data['about_desc'] . "</p>";
                            echo "      </div>";
                            echo "  </div>";
                        }
                        else
                        {
                            echo "  <br /><hr /><br />";
                            echo "  <h2>" . $data['about_title'] . "</h2>";
                            echo "  <p>" . $data['about_desc'] . "</p>";
                        }
                    }
                ?>
                <br />
            </div>
            <div id="developerContent">
                <h2>About the Developer</h2>
                <hr /><br />
                <p>SMARTink is a Product of <br /> Lara Ann Clarys Sarmiento <a  href="#"><input type="button" value="Details"></a>
            </div></p>
                <br />
               
            </div>
        </div>    
        
        <?php
			templateFooter();
		?>
    </body>
</html>