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
        <link rel="stylesheet" type="text/css" href="css/faq.css" />
        <link rel="stylesheet" type="text/css" href="css/editor.css" />
        <link rel="stylesheet" type="text/css" href="php_functions/jquery_styles.php" />
        <script src="functions.js"></script>
        <script src="jquery-2.0.3.js"></script>
        <title> SMARTink</title>
    </head>
    <body>
        <?php
			templateHeader();
		?>
        
        <div id="bodyContent">
            <div id="innerBody">
                <?php
                    if(isset($_SESSION['admin']))
                    {
                        echo "<editor align='center'><input type='button' value='edit FAQ' onclick=\"changePage('php_functions/CMSedit.php?part=2')\" /></editor>";
                    }
                ?>
                <div id="faqContent">
                    <h1>Frequently Asked Question</h1>
                    <hr /><br />
                    <?php
                        $sqlQuery = "SELECT * FROM faq_info";
                        $sendQuery = mysql_query($sqlQuery) or die(mysql_error());

                        while($data = mysql_fetch_assoc($sendQuery))
                        {
                            echo "  <p>Q: " . $data['faq_q'] . "<br />A: " . $data['faq_a'] . "</p><br />";
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