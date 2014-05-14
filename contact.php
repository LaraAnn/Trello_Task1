<!doctype html>
<html>
    <head>
		<?php
			include("php_functions/template.php");
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
		?>
        <link type="text/css" rel="stylesheet" href="css/template_style.css" />
        <link type="text/css" rel="stylesheet" href="css/contact.css" />
        <link rel="stylesheet" type="text/css" href="css/editor.css" />
        <link rel="stylesheet" type="text/css" href="php_functions/jquery_styles.php" />
        <script src="jquery-2.0.3.js"></script>
        <script src="functions.js"></script>
        <title> SMARTink</title>
    </head>
    <body>
        <?php
			templateHeader();
		?>
        
        <div id="bodyContent">
            <div id="contactContent">
                <?php
                    if(isset($_SESSION['admin']))
                    {
                        echo "<editor align='center'><input type='button' value='edit contacts' onclick=\"changePage('php_functions/CMSedit.php?part=4')\" /></editor>";
                    }
                    $sqlQuery = "SELECT * FROM contact_info";
                    $sendQuery = mysql_query($sqlQuery) or die(mysql_error);
                    
                    echo "  <h1>Contact</h1>
                            <hr /><br />";
                    while($data = mysql_fetch_assoc($sendQuery))
                    {
//                        if($data['contact_title'] != "Contact")
//                        {
//                            echo "      <br /><hr /><br />";
//                            echo "      <h2>" . $data['contact_title'] . "</h2>";
//                            echo "      <br />";
//                        }
//                        else
//                        {
//                            echo "      <h1>" . $data['contact_title'] . "</h1>";
//                            echo "      <br /><hr /><br />";
//                        }
//                        echo "          <div>" . $data['contact_desc'] . "</div>";
//                        echo "          <br/>";
                        echo "  <h2>" . $data['contact_title'] . "</h2>
                                <p>" . $data['contact_desc'] . "</p>
                                <br>";
                    }
                ?>
                
            </div>
        </div>
        
        <?php
			templateFooter();
		?>
    </body>
</html>