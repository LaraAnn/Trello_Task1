<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once("php_functions/dbconn.php");
            $db = new db();
            $db->connect();
        ?>
        <script src="jquery-2.0.3.js"></script>
        <script src="transactions.js"></script>
        <title>SMARTink</title>
    </head>
    <body onload="$('#inner').load('php_functions/view_all.php');">
        
    </body>
    <div id="inner" ></div>
</html>