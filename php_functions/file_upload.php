<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
            
            $part = isset($_POST['part']) ? $_POST['part'] : "";
            $fileName = isset($_SESSION['user']) ? $_SESSION['user'] : "";
        ?>
        <title>SMARTink</title>
        <link type="text/css" rel="stylesheet" href="../css/services.css">
        <script src="../jquery-2.0.3.js"></script>
        <script src="../services.js"></script>
    </head>
    <body style="margin: 0px; font-family: calibri;" 
        <?php 
            if(file_exists("../client_transactions/" . $fileName . "sample.jpg"))
            {
                echo "onload='loadPix(\"../client_transactions/" . $fileName . "sample.jpg\");'";
            }
            else
            {
                echo "onload='loadPix(\"x\");'";
            }
        ?>>
        <div id='imgloc'>
            <div id='cropimg'></div>
        </div>
        <?php
            if($part == 1)
            {
                fileUploadProcess();
            }
            else
            {
                fileUploadForm();
            }

            function fileUploadForm()
            {
                echo "  <form method='post' action='file_upload.php' enctype='multipart/form-data' name='imagePreview' id='imagePreview'>
                            upload image: <input type='file' accept='image/*' name='imagePreview' id='imagePreview' required>
                            <input type='submit' value='preview'>
                            <input type='hidden' name='part' id='part' value='1'>
                        </form>";
            }

            function fileUploadProcess()
            {
                move_uploaded_file($_FILES['imagePreview']['tmp_name'], "../client_transactions/" . $_SESSION['user'] . "sample.jpg");
//                copy("../client_transactions/" . $_SESSION['user'] . "sample.jpg", "../client_transactions/pictures/" . $_SESSION['user'] . "sample.jpg");
                header("Location:file_upload.php");
            }
        ?>
    </body>
</html>