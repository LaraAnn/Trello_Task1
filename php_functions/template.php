<?php
    session_start();
    function templateHeader()
    {
        $loggedIn = 0;
        echo "  <header> ";
        if(isset($_SESSION['admin']))
        {
            echo "<editor align='center'><input type='button' value='edit header' onclick=\"changePage('php_functions/CMSedit.php?part=7')\" /></editor>";
        }
        echo "      <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" height=\"100px\" id=\"headerContent\"> ";
        echo "          <tr> ";
        echo "              <td width=\"250px\" height=\"70px\" align=\"center\" valign=\"middle\"> ";
        echo "                  <a href='index.php'><img id=\"companyLogo\" src=\"images/SMARTinkLogo.png\" width=\"250px\" height=\"70px\" /> </a>";
        echo "              </td> ";
        echo "              <td width=\"950px\" align=\"right\" valign=\"top\"> ";
        echo "                  <div id=\"logIn\"> ";
        
        if(isset($_SESSION['admin']))
        {
            echo "                  Welcome back <strong>". $_SESSION['admin'] ."</strong>! Today is: " . date("l F j, Y", time()) . " | <a href='php_functions/transactions.php'>Transactions</a> | <a href='php_functions/CMSedit.php?part=5'>Settings</a> | <a href='php_functions/sign_out_func.php'>Sign out</a>";
        }
        else if(isset($_SESSION['user']))
        {
            echo "                  Welcome back <strong>". $_SESSION['firstName'] ."</strong>! Today is: " . date("l F j, Y", time()) . " | <a href='user_transact.php'>Requests</a> | <a href='edit_profile.php'>Edit profile</a> | <a href='php_functions/sign_out_func.php'>Sign out</a>";
        }
        else
        {
            echo "                  Not logged in | <a href=\"login.php\"> Sign in</a> ";
        }
        
        echo "                  </div> ";
        echo "              </td> ";
        echo "          </tr> ";
        echo "          <tr> ";
        echo "              <td colspan=\"4\" align=\"right\" id=\"navBox\" valign=\"bottom\"> ";
        echo "                  <div> ";
        echo "                      <a href=\"index.php\"> Home</a> ";
        echo "                      <a href=\"services.php\"> Services</a> ";
        echo "                      <a href=\"contact.php\"> Contact</a> ";
        echo "                      <a href=\"about.php\"> About</a> ";
        echo "                      <a href=\"faq.php\"> FAQ</a> ";
        echo "                  </div> ";
        echo "              </td> ";
        echo "          </tr> ";
        echo "      </table> ";
        echo "  </header> ";
    }
    
    function templateFooter()
    {
        echo "  <footer id=\"footerContent\">";
        if(isset($_SESSION['admin']))
        {
            echo "<editor align='center'><input type='button' value='edit footer' onclick=\"changePage('php_functions/CMSedit.php?part=8')\" /></editor>";
        }
        $sqlQuery = "SELECT * FROM footer_content";
        $sendQuery = mysql_query($sqlQuery) or die("ERROR: at getting footerContent >> " . mysql_error());
        
        while($data = mysql_fetch_assoc($sendQuery))
        {
            echo "      <div id=\"copyrightTab\">  " . $data['footer'] . " " . date("Y") . "</div> ";
        }
        
        echo "      <div id=\"footerNavBox\"> ";
        if(isset($_SESSION['admin']) || isset($_SESSION['user']))
        {
            echo "          <a href=\"php_functions/sign_out_func.php\"> Sign out</a> | ";
        }
        else
        {
            echo "          <a href=\"admin.php\"> Admin</a> | ";
        }
        echo "          <a href=\"contact.php\"> Contact</a> | ";
        echo "          <a href=\"about.php\"> About</a> | ";
        echo "          <a href=\"faq.php\"> FAQ </a> ";
        echo "      </div> ";
        echo "  </footer> ";
    }
?>