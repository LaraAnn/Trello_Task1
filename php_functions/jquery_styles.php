<?php
    header("Content-type:text/css");

    require_once("dbconn.php");
    $db = new db();
    $db->connect();

    $sqlQuery = "SELECT * FROM basic_setting";
    $sendQuery = mysql_query($sqlQuery) or die("ERROR: FETCHING DATA TO DATABASE >> " . mysql_error());
    $settings = array();

    while($data = mysql_fetch_array($sendQuery))
    {
        for($x = 0; $x < count($data); $x++)
        {
            $settings[$x] = $data[$x];
        }
    }

    if(strlen($settings[16]) == 1)
    {
        $value = "0" . $settings[16];
    }
    else
    {
        $value = $settings[16];
    }
?>

<?php //Header Style >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ?>

header table tr td, #navBox a, #logIn a
{
    color: <?php echo $settings[1];?>;
}

header table tr td
{
    background-color: <?php echo $settings[2];?>;
}

#navBox a:hover, #logIn a:hover, #leftContent #innerContent a:hover
{
    color: <?php echo $settings[3];?>;
    background-color: <?php echo $settings[4];?>;
}

<?php //Footer Style >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ?>

#footerContent, #footerNavBox a
{
    color: <?php echo $settings[5];?>;
}

#footerContent
{
    background-color: <?php echo $settings[6];?>;
}

#footerNavBox a:hover
{
    color: <?php echo $settings[7];?>;
    background-color: <?php echo $settings[8];?>;
}

<?php //Body Style >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ?>

body
{
    color: <?php echo $settings[9];?>;
    background-color: <?php echo $settings[10];?>;
}

h1, h2, h3
{
    color: <?php echo $settings[11];?>;
}

#events div, 
#leftContent #innerContent, #rightContent #innerContent, #cartContent,
#insideContent, #developerContent,
#contactContent,
#innerBody
{
    color: <?php echo $settings[12];?>;
    background-color: <?php echo $settings[13];?>;
    border-radius: <?php echo $settings[14] . "px";?>;
    box-shadow: <?php echo "0px 0px " . $settings[15] . "px rgba(0, 0, 0, ." . $value . ")"?>;
}

#leftContent #innerContent, #rightContent #innerContent, #cartContent,
#insideContent, #developerContent,
#contactContent,
#innerBody
{
    padding: <?php echo $settings[17] . "px";?>;
}