<!--<link type="text/css" rel="stylesheet" href="css/services.css">-->
<script src="services.js"></script>
<div id="tarpServiceForm">
    <form action="php_functions/servicesoffered.php" method="post" enctype="multipart/form-data" name="requestAddToCart" id="requestAddToCart">
        <div>
            <h2>Tarpaulin Printing</h2>
            <iframe id="imageForm" src="php_functions/file_upload.php" style="border: 0px; width: 100%; margin:0px; height: 450px;"></iframe>
            <br /><br />
            <div id='typeSize'>
                Width: <input type='number' name="width" value="2" min="2" max="30" id="width" oninput="currentPrice('width', 'height', '18', 'pricE')" /> ft. &nbsp;&nbsp; 
                Height: <input type='number' name="height" value="2" min="2" max="30" id="height" oninput="currentPrice('width', 'height', '18', 'pricE')" /> ft. 
                <span><b id="pricE" value='72'>Php 72</b></span> </div>
            <br />
            Remarks:
            <div id='remarks'>
                <textarea style='resize: none;' name="remarks"></textarea>
                <input type='submit' value='Add to cart'>
            </div>
        </div>
        <input type="hidden" name="imageLoc" id="imageLoc">
        <input type="hidden" name="totalPrice" id="totalPrice" value="72" />
        <input type="hidden" name="serviceType" value="1" />
    </form>
</div>

<div id="tarpServiceIndex">
    <?php
        session_start();

        if(isset($_SESSION['admin']))
        {
            echo "<editor align='center'><input type='button' value='edit tarpaulin printing' onclick=\"changePage('php_functions/CMSedit.php?part=9')\" /></editor>";
        }
    ?>
    <form action="service_form.php" method="post" name="introForm" id="introForm" enctype="multipart/form-data">
        <div id="mainForm">
            <h2>Tarpaulin Printing</h2><br>
            <div id="img" align="center">
                <img src="images/tarp2b3.jpeg" height="400px">
            </div>
            <div align="center">
                Upload your image to start: <input type="file" accept="image/*" name="imageFile" required>
                <input type="<?php
                                if(isset($_SESSION['admin']))
                                {
                                    echo "button";
                                }
                                else if(isset($_SESSION['user']))
                                {
                                    echo "submit";
                                }
                                else
                                {
                                    echo "button";
                                }
                             ?>" value="start" id="button"><br>
                <span style="font-size: 13px; color: red;">*Applicable only when you have already the available design.</span>
            </div>
        </div>
        <input type="hidden" name="serviceType" id="serviceType" value="1">
    </form>
</div>

<div id="shirtServiceIndex">
    <?php
        if(isset($_SESSION['admin']))
        {
            echo "<editor align='center'><input type='button' value='edit shirt printing' onclick=\"changePage('php_functions/CMSedit.php?part=10')\" /></editor>";
        }
    ?>
    <form action="service_form.php" method="post" name="introForm" id="introForm" enctype="multipart/form-data">
        <div id="mainForm">
            <h2>Shirt Printing</h2><br>
            <div id="img" align="center">
                <img src="images/tarp2b4.jpg" height="400px">
            </div>
            <div align="center">
                Select type of shirt to start: <select name="shirtType" id="shirtType">
                    <option value="rn">Round Neck</option>
                    <option value="ps">Polo Shirt</option>
<!--                    <option value="cs">Couple Shirt</option>-->
                </select>
                <input type="<?php
                                if(isset($_SESSION['admin']))
                                {
                                    echo "button";
                                }
                                else if(isset($_SESSION['user']))
                                {
                                    echo "submit";
                                }
                                else
                                {
                                    echo "button";
                                }
                             ?>" value="start" id="button">
            </div>
        </div>
        <input type="hidden" name="serviceType" id="serviceType" value="2">
    </form>
</div>

<div id="callingCardsServicesIndex">
    <?php

        if(isset($_SESSION['admin']))
        {
            echo "<editor align='center'><input type='button' value='edit tarpaulin printing' onclick=\"changePage('php_functions/CMSedit.php?part=9')\" /></editor>";
        }
    ?>
    <form action="service_form.php" method="post" name="introForm" id="introForm" enctype="multipart/form-data">
        <div id="mainForm">
            <h2>Calling Card</h2><br>
            <div id="img" align="center">
                <img src="images/tarp3b4.jpg" height="400px">
            </div>
            <div align="center">
                Upload your image to start: <input type="file" accept="image/*" name="imageFile" required>
                Card Size: <select name="cardSize" id="cardSize">
                    <option value="normal">Normal Business Card (3.5 inches by 2 inches)</option>
                    <option value="folded">Folded Business Card (3.75 inches by 2.25 inches)</option>
                    <option value="id1">ID-1 (3.370 inches by 2.125 inches)</option>
                </select>
                <input type="<?php
                                if(isset($_SESSION['admin']))
                                {
                                    echo "button";
                                }
                                else if(isset($_SESSION['user']))
                                {
                                    echo "submit";
                                }
                                else
                                {
                                    echo "button";
                                }
                             ?>" value="start" id="button"><br>
                <span style="font-size: 13px; color: red;">*Uploaded image will be resized accordingly to the nearest ID card size. Minimum of 100 pieces.</span>
            </div>
        </div>
        <input type="hidden" name="serviceType" id="serviceType" value="3">
    </form>
</div>

<div id="otherServices">
    <?php
        if(isset($_SESSION['admin']))
        {
            echo "<editor align='center'><input type='button' value='edit tarpaulin printing' onclick=\"changePage('php_functions/CMSedit.php?part=9')\" /></editor>";
        }
    ?>
    <div>
        <h2>Other Services</h2><br>
        <ul style="margin-left: 50px;">
            <li>
                Photo Printing (price starts at Php 10)
                <ul style="margin-left: 50px;">
                    <li>1x1 (minimum 4 pieces)</li>
                    <li>3r - 12r</li>
                    <li>Wallet Size</li>
                    <li>Cute Size</li>
                </ul>
            </li>
            <li>
                Sticker (price starts at Php 100)
                <ul style="margin-left: 50px;">
                    <li>Vinyl - minimum: 1 ft. by 4 ft.</li>
                    <li>Panaflex</li>
                </ul>
            </li>
            <li>Invitations (price starts at Php 10)</li>
            <li>Corporate ID (price starts at Php 20)</li>
            <li>
                Photo Booth (price starts at Php 3000)
                <ul style="margin-left: 50px;">
                    <li>Must be reserved with at least one month before</li>
                </ul>
            </li>
        </ul>
    </div>
    <br>
</div>