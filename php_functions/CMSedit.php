<!doctype html>
<html>
    <head>
        <script src="../jquery-2.0.3.js"></script>
        <script src="../CMSedit.js"></script>
        <title>Content Management System</title>
        <?php
            $mode = isset($_GET['part']) ? $_GET['part'] : "";
            $editorType = isset($_POST['actionType']) ? $_POST['actionType'] : "";
            require_once("dbconn.php");
            $db = new db();
            $db->connect();
        ?>
        <style>
            #sampleDiv
            {
                font-family: "calibri";
            }
            h1, h2, h3, p
            {
                margin: 0px;
                padding: 0px;
/*                font-size: 18px;*/
            }
        </style>
    </head>
    <body style='font-family: cambria;' onload="<?php if($mode == 5){echo "changEColor('div1', 'hFontColor'); changEColor('div2', 'hBColor'); changEColor('div3', 'hFontColorH'); changEColor('div4', 'hBColorH'); changEColor('div5', 'fFontColor'); changEColor('div6', 'fBColor'); changEColor('div7', 'fFontColorH'); changEColor('div8', 'fBColorH'); changEColor('div9', 'bodyFontColor'); changEColor('div10', 'bodyBGColor'); changEColor('div11', 'boxHColor'); changEColor('div12', 'boxFontColor'); changEColor('div13', 'boxBGColor');";}?>">
       <?php

            switch($mode)
            {
                case "1": // event panel
                {
                    if($editorType == 'edit')
                    {
                        eventEdit_update();
                    }
                    else if($editorType == 'delete')
                    {
                        eventEdit_delete();
                    }
                    else if($editorType == 'add')
                    {
                        eventEdit_addRow();
                    }
                    else
                    {
                        echo $editorType;
                        eventEdit();
                    }
                    break;
                }
                case "2": //faq 
                {
                    if($editorType == 'edit')
                    {
                        faqEdit_update();
                    }
                    else if($editorType == 'add')
                    {
                        faqEdit_addRow();
                    }
                    else if($editorType == 'delete')
                    {
                        faqEdit_delete();
                    }
                    else
                    {
                        echo $editorType;
                        faqEdit();
                    }
                    break;
                }
                case "3": // about
                {
                    if($editorType == 'edit')
                    {
                        aboutEdit_update();
                    }
                    else if($editorType == 'add')
                    {
                        aboutEdit_addRow();
                    }
                    else if($editorType == 'delete')
                    {
                        aboutEdit_delete();
                    }
                    else
                    {
                        echo $editorType;
                        aboutEdit();
                    }
                    break;
                }
                case "4": // contact
                {
                   if($editorType == 'edit')
                    {
                        contactEdit_update();
                    }
                    else if($editorType == 'add')
                    {
                        contactEdit_addRow();
                    }
                    else if($editorType == 'delete')
                    {
                        contactEdit_delete();
                    }
                    else
                    {
                        echo $editorType;
                        contactEdit();
                    }
                    break;
                }
                case "5": // settings
                {
                    if($editorType == 'edit')
                    {
                        basicEditor_edit();
                    }
                    else
                    {
                        basicEditor();
                    }
                    break;
                }
                case "6": // slider
                {
                    if($editorType == 'upload')
                    {
                        sliderEditor_pictureUpload();
                    }
                    else if($editorType == 'edit')
                    {
                        sliderEditor_edit();
                    }
                    else
                    {
                        sliderEditor();
                    }
                    break;
                }
                case "7": // header
                {
                    if($editorType == 'upload')
                    {
                        headerEditor_upload();
                    }
                    else
                    {
                        headerEditor();
                    }
                    break;
                }
                case "8": // header
                {
                    if($editorType == 'edit')
                    {
                        footerEditor_edit();
                    }
                    else
                    {
                        footerEditor();
                    }
                    break;
                }
                case "9":
                {
                    if($editorType == 'upload')
                    {
                        tarpEditor_upload();
                    }
                    else
                    {
                        tarpEditor();
                    }
                    break;
                }
                case "10":
                {
                    if($editorType == 'upload')
                    {
                        shirtEditor_upload();
                    }
                    else
                    {
                        shirtEditor();
                    }
                    break;
                }
            }
            
            function eventEdit()
            {
                $sqlQuery = "SELECT * FROM events";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                echo "  <form method='post' action='CMSedit.php?part=1' id='formEdit' name='formEdit'>";
                echo "      <table cellspacing='0' cellpadding='0' border='1' style='border: 1px solid;' align='center'>";
                echo "          <tr><th colspan='3' style='background-color: #000; color: #fff; padding: 10px;'>Events Editor</th></tr>";
                echo "          <tr><th style='border-right: 2px solid #000; background-color: #555; color: #fff; padding: 5px 0px; '>check</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>event_title</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>event_desc</th></tr>";
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "      <tr>";
                    echo "          <td valign='top' align='center' style='border-right: 2px solid;'><input type='checkbox' name='checklist[]' value='" . $data['id_event'] . "'/></td>";
                    echo "          <td valign='top'><input type='text' name='event_title[]' value='" . $data['event_title'] . "' /></td>";
                    echo "          <td width='300px' height='100px' style='padding: 5px;'><textarea name='event_desc[]' style='width:97%; height:100%; resize: none;'>" . $data['event_desc'] . "</textarea></td>";
                    echo "          <input type='hidden' name='id_event[]' value='" . $data['id_event'] . "' />";
                    echo "      </tr>";
                }
                
                echo "          <input type='hidden' id='actionType' name='actionType'/>";
                echo "      <tr><td align='center' style='border-right: 2px solid;'><input type='button' value='delete' onclick='editorType(\"actionType\",\"delete\")' /></td><td colspan='3' align='center'><input type='button' value='add row' onclick='editorType(\"actionType\",\"add\")' /><input type='button' value='save data' onclick='editorType(\"actionType\",\"edit\")' /></td></tr>";
                echo "      </table>";
                echo "  </form>";
            }
        
            function eventEdit_update()
            {
                $id_event = ($_POST['id_event']);
                $event_title = $_POST['event_title'];
                $event_desc = $_POST['event_desc'];
                
                for($x = 0; $x < count($event_title); $x++)
                {
                    $sqlQuery = "UPDATE events SET event_title='" . $event_title[$x] . "', event_desc='" . $event_desc[$x] . "' WHERE id_event=" . $id_event[$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=1");
            }
        
            function eventEdit_delete()
            {
                $toBeDeleted = isset($_POST['checklist']) ? $_POST['checklist'] : "";
                
                if($toBeDeleted != "")
                {
                    for($x = 0; $x < count($toBeDeleted); $x++)
                    {
                        $sqlQuery = "DELETE FROM events WHERE id_event=" . $toBeDeleted[$x];
                        mysql_query($sqlQuery) or die(mysql_error());
                    }
                }
                header("Location:CMSedit.php?part=1");
            }
            
            function eventEdit_addRow()
            {
                $sqlQuery = "INSERT INTO events(event_title, event_desc) VALUES('','') ";
                mysql_query($sqlQuery) or die(mysql_error());
                
                header("Location:CMSedit.php?part=1");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function faqEdit()
            {
                $sqlQuery = "SELECT * FROM faq_info";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                echo "  <form method='post' action='CMSedit.php?part=2' id='formEdit' name='formEdit'>";
                echo "      <table cellspacing='0' cellpadding='0' border='1' style='border: 1px solid;' align='center'>";
                echo "          <tr><th colspan='3' style='background-color: #000; color: #fff; padding: 10px;'>Frequently Ask Questions Editor</th></tr>";
                echo "          <tr><th style='border-right: 2px solid black; background-color: #555; color: #fff; padding: 5px 0px;'>check</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>faq_q</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>faq_a</th></tr>";
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "      <tr>";
                    echo "          <td valign='top' align='center' style='border-right: 2px solid;'><input type='checkbox' name='checklist[]' value='" . $data['id_faq'] . "'/></td>";
                    echo "          <td height='100px' style='padding: 5px;'><textarea name='faq_q[]' style='height: 100%; resize: none;'>" . $data['faq_q'] . "</textarea></td>";
                    echo "          <td width='300px' height='100px' style='padding: 5px;'><textarea name='faq_a[]' style='width:97%; height:100%; resize: none;'>" . $data['faq_a'] . "</textarea></td>";
                    echo "          <input type='hidden' name='id_faq[]' value='" . $data['id_faq'] . "' />";
                    echo "      </tr>";
                }
                
                echo "          <input type='hidden' id='actionType' name='actionType'/>";
                echo "      <tr><td align='center' style='border-right: 2px solid;'><input type='button' value='delete' onclick='editorType(\"actionType\",\"delete\")' /></td><td colspan='3' align='center'><input type='button' value='add row' onclick='editorType(\"actionType\",\"add\")' /><input type='button' value='save data' onclick='editorType(\"actionType\",\"edit\")' /></td></tr>";
                echo "      </table>";
                echo "  </form>";
            }

            function faqEdit_update()
            {
                $id_faq = ($_POST['id_faq']);
                $faq_q = $_POST['faq_q'];
                $faq_a = $_POST['faq_a'];
                
                for($x = 0; $x < count($faq_q); $x++)
                {
                    $sqlQuery = "UPDATE faq_info SET faq_q='" . $faq_q[$x] . "', faq_a='" . $faq_a[$x] . "' WHERE id_faq=" . $id_faq[$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=2");
            }

            function faqEdit_addRow()
            {
                $sqlQuery = "INSERT INTO faq_info(faq_q, faq_a) VALUES('','') ";
                mysql_query($sqlQuery) or die(mysql_error());
                
                header("Location:CMSedit.php?part=2");
            }

            function faqEdit_delete()
            {
                $toBeDeleted = isset($_POST['checklist']) ? $_POST['checklist'] : "";
                
                if($toBeDeleted != "")
                {
                    for($x = 0; $x < count($toBeDeleted); $x++)
                    {
                        $sqlQuery = "DELETE FROM faq_info WHERE id_faq=" . $toBeDeleted[$x];
                        mysql_query($sqlQuery) or die(mysql_error());
                    }
                }
                header("Location:CMSedit.php?part=2");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function aboutEdit()
            {
                $sqlQuery = "SELECT * FROM about_info";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                
                echo "  <form method='post' action='CMSedit.php?part=3' id='formEdit' name='formEdit'>";
                echo "      <table cellspacing='0' cellpadding='0' border='1' style='border: 1px solid;' align='center'>";
                echo "          <tr><th colspan='3' style='background-color: #000; color: #fff; padding: 10px;'>About Editor</th></tr>";
                echo "          <tr><th style='border-right: 2px solid black; background-color: #555; color: #fff; padding: 5px 0px;'>check</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>about_title</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>about_desc</th></tr>";
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "      <tr>";
                    if($data['id_about'] == '1' || $data['id_about'] == '2' || $data['id_about'] == '3' || $data['id_about'] == '4')
                    {
                        echo "          <td valign='top' align='center' style='border-right: 2px solid;'></td>"; 
                        echo "          <td valign='top'><input type='text' name='about_title[]' value='" . $data['about_title'] . "' readonly /></td>";
                    }
                    else
                    {
                        echo "          <td valign='top' align='center' style='border-right: 2px solid;'><input type='checkbox' name='checklist[]' value='" . $data['id_about'] . "'/></td>";
                        echo "          <td valign='top'><input type='text' name='about_title[]' value='" . $data['about_title'] . "' /></td>";
                    }
                    echo "          <td width='300px' height='100px' style='padding: 5px;'><textarea name='about_desc[]' style='width:97%; height:100%; resize: none;' >" . $data['about_desc'] . "</textarea></td>";
                    echo "          <input type='hidden' name='id_about[]' value='" . $data['id_about'] . "' />";
                    echo "      </tr>";
                }
                
                echo "          <input type='hidden' id='actionType' name='actionType'/>";
                echo "      <tr><td align='center' style='border-right: 2px solid;'><input type='button' value='delete' onclick='editorType(\"actionType\",\"delete\")' /></td><td colspan='3' align='center'><input type='button' value='add row' onclick='editorType(\"actionType\",\"add\")' /><input type='button' value='save data' onclick='editorType(\"actionType\",\"edit\")' /></td></tr>";
                echo "      </table>";
                echo "  </form>";
            }

            function aboutEdit_update()
            {
                $id_about = ($_POST['id_about']);
                $about_title = $_POST['about_title'];
                $about_desc = $_POST['about_desc'];
                
                for($x = 0; $x < count($about_title); $x++)
                {
                    $sqlQuery = "UPDATE about_info SET about_title='" . $about_title[$x] . "', about_desc='" . $about_desc[$x] . "' WHERE id_about=" . $id_about[$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=3");
            }

            function aboutEdit_addRow()
            {
                $sqlQuery = "INSERT INTO about_info(about_title, about_desc) VALUES('','') ";
                mysql_query($sqlQuery) or die(mysql_error());
                
                header("Location:CMSedit.php?part=3");
            }

            function aboutEdit_delete()
            {
                $toBeDeleted = isset($_POST['checklist']) ? $_POST['checklist'] : "";
                
                if($toBeDeleted != "")
                for($x = 0; $x < count($toBeDeleted); $x++)
                {
                    $sqlQuery = "DELETE FROM about_info WHERE id_about=" . $toBeDeleted[$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=3");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function contactEdit()
            {
                $sqlQuery = "SELECT * FROM contact_info";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                
                echo "  <form method='post' action='CMSedit.php?part=4' id='formEdit' name='formEdit'>";
                echo "      <table cellspacing='0' cellpadding='0' border='1' style='border: 1px solid;' align='center'>";
                echo "          <tr><th colspan='3' style='background-color: #000; color: #fff; padding: 10px;'>Contact Editor</th></tr>";
                echo "          <tr><th style='border-right: 2px solid black; background-color: #555; color: #fff; padding: 5px 0px;'>check</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>contact_title</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>contact_desc</th></tr>";
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "      <tr>";
                    if($data['id_contact'] == '3' || $data['id_contact'] == '4')
                    {
                        echo "          <td valign='top' align='center' style='border-right: 2px solid;'></td>"; 
                        echo "          <td valign='top'><input type='text' name='contact_title[]' value='" . $data['contact_title'] . "' readonly /></td>";
                    }
                    else
                    {
                        echo "          <td valign='top' align='center' style='border-right: 2px solid;'><input type='checkbox' name='checklist[]' value='" . $data['id_contact'] . "'/></td>";
                        echo "          <td valign='top'><input type='text' name='contact_title[]' value='" . $data['contact_title'] . "' /></td>";
                    }
                    echo "          <td width='300px' height='100px' style='padding: 5px;'><textarea name='contact_desc[]' style='width:97%; height:100%; resize: none;' >" . $data['contact_desc'] . "</textarea></td>";
                    echo "          <input type='hidden' name='id_contact[]' value='" . $data['id_contact'] . "' />";
                    echo "      </tr>";
                }
                
                echo "          <input type='hidden' id='actionType' name='actionType'/>";
                echo "      <tr><td align='center' style='border-right: 2px solid;'><input type='button' value='delete' onclick='editorType(\"actionType\",\"delete\")' /></td><td colspan='3' align='center'><input type='button' value='add row' onclick='editorType(\"actionType\",\"add\")' /><input type='button' value='save data' onclick='editorType(\"actionType\",\"edit\")' /></td></tr>";
                echo "      </table>";
                echo "  </form>";
            }

            function contactEdit_update()
            {
                $id_contact = ($_POST['id_contact']);
                $contact_title = $_POST['contact_title'];
                $contact_desc = $_POST['contact_desc'];
                
                for($x = 0; $x < count($contact_title); $x++)
                {
                    $sqlQuery = "UPDATE contact_info SET contact_title='" . $contact_title[$x] . "', contact_desc='" . $contact_desc[$x] . "' WHERE id_contact=" . $id_contact[$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=4");
            }

            function contactEdit_addRow()
            {
                $sqlQuery = "INSERT INTO contact_info(contact_title, contact_desc) VALUES('','') ";
                mysql_query($sqlQuery) or die(mysql_error());
                
                header("Location:CMSedit.php?part=4");
            }

            function contactEdit_delete()
            {
                $toBeDeleted = isset($_POST['checklist']) ? $_POST['checklist'] : "";
                
                if($toBeDeleted != "")
                for($x = 0; $x < count($toBeDeleted); $x++)
                {
                    $sqlQuery = "DELETE FROM contact_info WHERE id_contact=" . $toBeDeleted[$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=4");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function basicEditor()
            {
                $colors = array("black", "white", "gray", "lightgray", "darkgray", "red", "darkred", "maroon", "green", "lightgreen", "darkgreen", "blue", "darkblue", "lightblue", "yellow", "cyan", "magenta", "pink", "violet", "brown");
                $sqlQuery = "SELECT * FROM basic_setting";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                echo "  <form method='post' action='CMSedit.php?part=5' id='formEdit' name='formEdit'>";
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "  <table cellspacing='0' cellpadding='0' border='1' align='center' style='border: 1px solid; width: 800px;'>
                                <tr><th colspan='4' style='background-color: #000; color: #fff; padding: 10px;'>Settings</th></tr>
                                <tr>
                                    <th colspan='2' style='background-color: #222; color: #fff; padding: 10px;' align='left'>Header</th>
                                    <th colspan='2' style='background-color: #222; color: #fff; padding: 10px;' align='left'>Footer</th></tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px; width: 30%;'>Font Color: </td>
                                    <td style='width: 20%;'>
                                        <select name='hFontColor' id='hFontColor' style='background-color: lightgray;' onchange='changEColor(\"div1\", \"hFontColor\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['header_fc'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div1'></div>
                                    </td>
                                    
                                    <td style='background-color: #555; color: #fff; padding: 10px; width: 30%;'>Font Color: </td>
                                    <td style='width: 20%;'>
                                        <select name='fFontColor' id='fFontColor' style='background-color: lightgray;' onchange='changEColor(\"div5\", \"fFontColor\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['footer_fc'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div5'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Background Color: </td>
                                    <td>
                                        <select name='hBColor' id='hBColor' style='background-color: lightgray;' onchange='changEColor(\"div2\", \"hBColor\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['header_bgc'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div2'></div>
                                    </td>
                                    
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Background Color: </td>
                                    <td>
                                        <select name='fBColor' id='fBColor' style='background-color: lightgray;' onchange='changEColor(\"div6\", \"fBColor\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['footer_bgc'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div6'></div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Font Color (Hover): </td>
                                    <td>
                                        <select name='hFontColorH' id='hFontColorH' style='background-color: lightgray;' onchange='changEColor(\"div3\", \"hFontColorH\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['header_fch'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div3'></div>
                                    </td>
                                    
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Font Color (Hover): </td>
                                    <td>
                                        <select name='fFontColorH' id='fFontColorH' style='background-color: lightgray;' onchange='changEColor(\"div7\", \"fFontColorH\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['footer_fch'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div7'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Background Color (Hover): </td>
                                    <td>
                                        <select name='hBColorH' id='hBColorH' style='background-color: lightgray;' onchange='changEColor(\"div4\", \"hBColorH\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['header_bgch'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div4'></div>
                                    </td>
                                    
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Background Color (Hover): </td>
                                    <td>
                                        <select name='fBColorH' id='fBColorH' style='background-color: lightgray;' onchange='changEColor(\"div8\", \"fBColorH\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['footer_bgch'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div8'></div>
                                    </td>
                                </tr>
                                <tr><th colspan='4' style='background-color: #222; color: #fff; padding: 10px;' align='left'>Body</th></tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Font Color (General): </td>
                                    <td>
                                        <select name='bodyFontColor' id='bodyFontColor' style='background-color: lightgray;' onchange='changEColor(\"div9\", \"bodyFontColor\"); boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['body_fontcolor'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }                        
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div9'></div>
                                    </td>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Background Color (General): </td>
                                    <td>
                                        <select name='bodyBGColor' id='bodyBGColor' style='background-color: lightgray;' onchange='changEColor(\"div10\", \"bodyBGColor\"); boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['body_bgcolor'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }                        
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div10'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Header Color (Box):</td><td>
                                        <select name='boxHColor' id='boxHColor' style='background-color: lightgray;' onchange='changEColor(\"div11\", \"boxHColor\"); boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['box_headercolor'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div11'></div>
                                    </td>
                                    <td colspan='2' rowspan='7' id='bodyBody' style='background-color: " . $data['body_bgcolor'] . ";'>
                                        <div style='background-color: rgba(255, 255, 255, .7); padding: 10px;'>
                                            <div id='sampleDiv' style='margin: 20px; padding: " . $data['box_padding'] . "px; background-color: " . $data['box_bgcolor'] . "; border-radius: " . $data['box_borderradius'] . "px; box-shadow: 0px 0px " . $data['box_shadow'] . "px rgba(0, 0, 0, " . ($data['box_shadowopacity'] * .01) . ");'>
                                                <h1 style='color: " . $data['box_headercolor'] . ";'>Main Header</h1><hr><br>
                                                <h2 style='color: " . $data['box_headercolor'] . ";'>Sub Header</h2><br>
                                                <h3 style='color: " . $data['box_headercolor'] . ";'>Sub Sub Header</h3><br>
                                                <p style='color: " . $data['box_fontcolor'] . ";'>The Quick Brown Fox Jumps Over The Lazy Dog.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Font Color (Box):</td><td>
                                        <select name='boxFontColor' id='boxFontColor' style='background-color: lightgray;' onchange='changEColor(\"div12\", \"boxFontColor\"); boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['box_fontcolor'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div12'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Background Color (Box):</td><td>
                                        <select name='boxBGColor' id='boxBGColor' style='background-color: lightgray;' onchange='changEColor(\"div13\", \"boxBGColor\"); boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>";
                    for($x = 0; $x < count($colors); $x++)
                    {
                        if($data['box_bgcolor'] == $colors[$x])
                        {
                            echo "              <option value='" . $colors[$x] . "' selected>" . $colors[$x] . "</option>";
                        }
                        else
                        {
                            echo "              <option value='" . $colors[$x] . "'>" . $colors[$x] . "</option>";
                        }
                    }
                    echo "              </select>
                                        <div style='background-color: red; display: inline-block; width: 60px; height: 10px; border: 1px solid black;' id='div13'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Border Radius (Box):</td><td align='center'>
                                        <input type='range' name='boxRadius' id='boxRadius' min='1' max='30' value='" . $data['box_borderradius'] . "' onchange='boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Box Shadow (Box):</td><td align='center'>
                                        <input type='range' name='boxShadow' id='boxShadow' min='1' max='30' value='" . $data['box_shadow'] . "' onchange='boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Shadow Opacity (Box):</td><td align='center'>
                                        <input type='range' name='boxShadowOpacity' id='boxShadowOpacity' min='1' max='99' value='" . $data['box_shadowopacity'] . "' value='" . $data['box_padding'] . "' onchange='boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background-color: #555; color: #fff; padding: 10px;'>Padding (Box):</td><td align='center'>
                                        <input type='range' name='boxPadding' id='boxPadding' min='1' max='15' value='" . $data['box_padding'] . "' onchange='boxEditor(\"bodyFontColor\", \"bodyBGColor\", \"boxHColor\", \"boxFontColor\", \"boxBGColor\", \"boxRadius\", \"boxShadow\", \"boxShadowOpacity\", \"boxPadding\");'>
                                    </td>
                                </tr>
                                <tr><td colspan='4' align='center' style='padding: 5px;'><input type='button' value='Apply' onclick='editorType(\"actionType\",\"edit\")'><input type='button' value='Reset' onclick='editorType(\"actionType\",\"\")'></td></tr>
                            </table>
                            <input type='hidden' name='actionType' id='actionType'>";
                }
                echo "  </form>";
            }

            function basicEditor_edit()
            {
                $sqlQuery = "UPDATE basic_setting SET header_fc='" . $_POST['hFontColor'] . "', header_bgc='" . $_POST['hBColor'] . "', header_fch='" . $_POST['hFontColorH'] . "', header_bgch='" . $_POST['hBColorH'] . "', footer_fc='" . $_POST['fFontColor'] . "', footer_bgc='" . $_POST['fBColor'] . "', footer_fch='" . $_POST['fFontColorH'] . "', footer_bgch='" . $_POST['fBColorH'] . "', body_fontColor='" . $_POST['bodyFontColor'] . "', body_bgcolor='" . $_POST['bodyBGColor'] . "', box_headercolor='" . $_POST['boxHColor'] . "', box_fontcolor='" . $_POST['boxFontColor'] . "', box_bgcolor='" . $_POST['boxBGColor'] . "', box_borderradius='" . $_POST['boxRadius'] . "', box_shadow='" . $_POST['boxShadow'] . "', box_shadowopacity='" . $_POST['boxShadowOpacity'] . "', box_padding='" . $_POST['boxPadding'] . "' WHERE id='1'";
                
                mysql_query($sqlQuery) or die("ERROR AT UPDATING basic_setting" . mysql_error());
                
                header("Location:CMSedit.php?part=5");
            }
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function sliderEditor()
            {
                $sqlQuery = "SELECT * FROM slider_info";
                $sendQuery = mysql_query($sqlQuery) or die(mysql_error());
                echo "  <form method='post' action='CMSedit.php?part=6' id='formEdit' name='formEdit' enctype='multipart/form-data'>";
                echo "      <table cellspacing='0' cellpadding='0' border='1' style='border: 1px solid;' align='center'>";
                echo "          <tr><th colspan='3' style='background-color: #000; color: #fff; padding: 10px;'>Events Editor</th></tr>";
                echo "          <tr><th style='border-right: 2px solid #000; background-color: #555; color: #fff; padding: 5px 0px; '>slider_pic_source</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>slider_header</th><th style='background-color: #555; color: #fff; padding: 5px 0px;'>slider_desc</th></tr>";
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "      <tr>";
                    echo "          <td valign='top' align='center' style='border-right: 2px solid;'>
                                        <div align='left' style='position: absolute; background-color: rgba(255, 255, 255, .75); margin-top: 10px; margin-left: 5px; padding: 3px; border-radius: 2px;'>
                                            <input type='file' name='image" . $data['slider_id'] . "' id='image" . $data['slider_id'] . "' accept='image/*'><br>
                                            <input type='button' value='replace' onclick=' checkValue(\"image" . $data['slider_id'] . "\", \"uploadNumber\", \"image" . $data['slider_id'] . "\", \"actionType\",\"upload\");'>
                                        </div>
                                        <img src='../" . $data['slider_pic_source'] . "' width='300' style='margin-top: 4px;'></td>";
                    echo "          <td valign='top'><input type='text' name='slider_header[]' value='" . $data['slider_header'] . "' /></td>";
                    echo "          <td width='300px' height='100px' style='padding: 5px;'><textarea name='slider_desc[]' style='width:97%; height:100%; resize: none;'>" . $data['slider_desc'] . "</textarea></td>";
                    echo "          <input type='hidden' name='slider_id[]' value='" . $data['slider_id'] . "' />";
                    echo "      </tr>";
                }
                
                echo "          <input type='hidden' id='actionType' name='actionType'/>";
                echo "          <input type='hidden' id='uploadNumber' name='uploadNumber'/>";
                echo "      <tr><td align='center' style='border-right: 2px solid;'></td><td colspan='3' align='center'><input type='button' value='save data' onclick='editorType(\"actionType\",\"edit\")' /></td></tr>";
                echo "      </table>";
                echo "  </form>";
            }

            function sliderEditor_pictureUpload()
            {
                if($_POST['uploadNumber'] == 'image1')
                {
                    move_uploaded_file($_FILES['image1']['tmp_name'], "../images/indexImage1.jpg");
                }
                else if($_POST['uploadNumber'] == 'image2')
                {
                    move_uploaded_file($_FILES['image2']['tmp_name'], "../images/indexImage2.jpg");
                }
                else if($_POST['uploadNumber'] == 'image3')
                {
                    move_uploaded_file($_FILES['image3']['tmp_name'], "../images/indexImage3.jpg");
                }
                
                header("Location:CMSedit.php?part=6");
            }

            function sliderEditor_edit()
            {
                for($x = 0; $x < count($_POST['slider_id']); $x++)
                {
                    $sqlQuery = "UPDATE slider_info SET slider_header='" . $_POST['slider_header'][$x] . "', slider_desc='" . $_POST['slider_desc'][$x] . "' WHERE slider_id=" . $_POST['slider_id'][$x];
                    mysql_query($sqlQuery) or die(mysql_error());
                }
                header("Location:CMSedit.php?part=6");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function headerEditor()
            {
                echo "  <form method='post' action='CMSedit.php?part=7' id='formEdit' name='formEdit' enctype='multipart/form-data'>
                            <table align='center' border='1' cellpadding='0' cellspacing='0' style='border: 1px solid;'>
                                <tr><th style='background-color: #000; color: #fff; padding: 10px;'>Website Logo</th></tr>
                                <tr>
                                    <td>
                                        <div style='position: absolute; background-color: rgba(255, 255, 255, .75); margin-top: 10px; margin-left: 5px; padding: 3px; border-radius: 2px;'>
                                            <input type='file' name='logoImage' id='logoImage' accept='image/*'>
                                            <input type='button' value='replace' onclick='checkValue(\"logoImage\", \"extra\", \"extra\", \"actionType\",\"upload\");'>
                                        </div>
                                        <img src='../images/SMARTinkLogo.png' width='500px' height='140px' style='padding-top: 4px;'>
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' id='actionType' name='actionType'>
                            <input type='hidden' id='extra' name='extra'>
                        </form>";
            }

            function headerEditor_upload()
            {
                move_uploaded_file($_FILES['logoImage']['tmp_name'], "../images/SMARTinkLogo.png");
                header("Location:CMSedit.php?part=7");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function footerEditor()
            {
                $sqlQuery = "SELECT * FROM footer_content";
                $sendQuery = mysql_query($sqlQuery) or die("ERROR: at getting values of footer_content >> " . mysql_error());
                
                while($data = mysql_fetch_assoc($sendQuery))
                {
                    echo "  <form method='post' action='CMSedit.php?part=8' id='formEdit' name='formEdit' enctype='multipart/form-data'>
                                <table align='center' border='1' cellpadding='0' cellspacing='0' style='border: 1px solid;'>
                                    <tr><th style='background-color: #000; color: #fff; padding: 10px;'>Footer Content</th></tr>
                                    <tr>
                                        <td style='width: 300px; height: 100px;' align='center' valign='middle'>
                                            <textarea name='footer' id='footer' style='resize: none; width: 95%; height: 90%;'>" . stripslashes($data['footer']) . "</textarea>
                                        </td>
                                    </tr>
                                    <tr><td align='center'><input type='button' value='save data' onclick='editorType(\"actionType\",\"edit\")'></td></tr>
                                </table>
                                <input type='hidden' id='actionType' name='actionType'>
                            </form>";
                }
            }

            function footerEditor_edit()
            {
                $sqlQuery = "UPDATE footer_content SET footer='" . $_POST['footer'] . "'";
                mysql_query($sqlQuery) or die("ERROR: at updating footer_content >> " . mysql_error());
                header("Location:CMSedit.php?part=8");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function tarpEditor()
            {
                echo "  <form method='post' action='CMSedit.php?part=9' id='formEdit' name='formEdit' enctype='multipart/form-data'>
                            <table align='center' border='1' cellpadding='0' cellspacing='0' style='border: 1px solid;'>
                                <tr><th style='background-color: #000; color: #fff; padding: 10px;'>Tarpauling Printing Intro Picture</th></tr>
                                <tr>
                                    <td>
                                        <div style='position: absolute; background-color: rgba(255, 255, 255, .75); margin-top: 10px; margin-left: 5px; padding: 3px; border-radius: 2px;'>
                                            <input type='file' name='logoImage' id='logoImage' accept='image/*'>
                                            <input type='button' value='replace' onclick='checkValue(\"logoImage\", \"extra\", \"extra\", \"actionType\",\"upload\");'>
                                        </div>
                                        <img src='../images/tarp2b3.jpeg' height='450px' style='padding-top: 4px;'>
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' id='actionType' name='actionType'>
                            <input type='hidden' id='extra' name='extra'>
                        </form>";
            }

            function tarpEditor_upload()
            {
                move_uploaded_file($_FILES['logoImage']['tmp_name'], "../images/tarp2b3.jpeg");
                header("Location:CMSedit.php?part=9");
            }

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function shirtEditor()
            {
                echo "  <form method='post' action='CMSedit.php?part=10' id='formEdit' name='formEdit' enctype='multipart/form-data'>
                            <table align='center' border='1' cellpadding='0' cellspacing='0' style='border: 1px solid;'>
                                <tr><th style='background-color: #000; color: #fff; padding: 10px;'>Tarpauling Printing Intro Picture</th></tr>
                                <tr>
                                    <td>
                                        <div style='position: absolute; background-color: rgba(255, 255, 255, .75); margin-top: 10px; margin-left: 5px; padding: 3px; border-radius: 2px;'>
                                            <input type='file' name='logoImage' id='logoImage' accept='image/*'>
                                            <input type='button' value='replace' onclick='checkValue(\"logoImage\", \"extra\", \"extra\", \"actionType\",\"upload\");'>
                                        </div>
                                        <img src='../images/tarp2b4.jpg' height='450px' style='padding-top: 4px;'>
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' id='actionType' name='actionType'>
                            <input type='hidden' id='extra' name='extra'>
                        </form>";
            }

            function shirtEditor_upload()
            {
                move_uploaded_file($_FILES['logoImage']['tmp_name'], "../images/tarp2b4.jpg");
                header("Location:CMSedit.php?part=10");
            }
        ?>
        <div style="text-align: center; margin: 5px;"><a href="../index.php" style="color: blue;"> << go back to SMARTink </a></div>
    </body>
</html>