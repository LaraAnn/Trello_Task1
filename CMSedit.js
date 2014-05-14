function editorType(iD, val)
{
    document.getElementById(iD).value = val;
    window.formEdit.submit();
}

function uploadQue(iD, val)
{
    document.getElementById(iD).value = val;
}

function checkValue(iD1, iD2, val2, iD3, val3)
{
    if(document.getElementById(iD1).value != "")
    {
        var boxDialogue = confirm("Old picture will be deleted. Continue?");
        if(boxDialogue == true)
        {
            document.getElementById(iD2).value = val2;
            document.getElementById(iD3).value = val3;
//            alert("");
            window.formEdit.submit();
        }
    }
    else
    {
        alert("Upload photo first!");
    }
}

function changEColor(iD1, iD2)
{
    $("#" + iD1).css({
        "background-color" : document.getElementById(iD2).value
    });
//    alert("asd");
}

function boxEditor(fontColor, bgColor, headerColor, textColor, boxbgColor, boxRadius, boxShadow, boxShadowOpacity, boxPadding)
{
    $("#bodyBody").css(
        {
            "background-color" : document.getElementById(bgColor).value.toString()
        }
    );
    
     $("#sampleDiv h1, #sampleDiv h2, #sampleDiv h3").css(
        {
            "color" :  document.getElementById(headerColor).value.toString()
        }
    );
    
    $("#sampleDiv p").css(
        {
            "color" :  document.getElementById(textColor).value.toString()
        }
    );
    
    var shadowOpAcity = "";
    
    if(document.getElementById(boxShadowOpacity).value.toString().length == 1)
    {
        shadowOpacity = "0" + document.getElementById(boxShadowOpacity).value.toString();
    }
    else 
    {
        shadowOpacity = document.getElementById(boxShadowOpacity).value.toString();
    }
    
    $("#sampleDiv").css(
        {
            "color" :  document.getElementById(fontColor).value.toString(),
            "background-color" :  document.getElementById(boxbgColor).value.toString(),
            "border-radius" :  document.getElementById(boxRadius).value.toString() + "px", 
            "box-shadow" : "0px 0px " + document.getElementById(boxShadow).value.toString() + "px rgba(0, 0, 0, ." + shadowOpacity + ")",
            "padding" :  document.getElementById(boxPadding).value.toString() + "px"
        }
    );
    
//    alert(document.getElementById("boxShadowOpacity").value);
}