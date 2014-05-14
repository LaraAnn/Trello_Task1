var i = 0, leftScroll = 0, isAnimating = 0, X = 0;

function radioSlide()
{
	var radioBtn = 0;
	
    if(isAnimating == 0)
    {
        if(document.getElementById("sliderRadio1").checked == true)
        {
            isAnimating = 1;
            radioBtn = 0;
        }
        else if(document.getElementById("sliderRadio2").checked == true)
        {
            isAnimating = 1;
            radioBtn = 1;
        }
        else if(document.getElementById("sliderRadio3").checked == true)
        {
            isAnimating = 1;
            radioBtn = 2;
        }
    }
	
    if(isAnimating == 1)
    {
        $("#overflow").css({
            "margin-left" : radioBtn*-900 + "px"
        });
        
        isAnimating = 0;
    }
}

function initializE()
{
    for(X = 0; X < 3; X++)
    {        
        $("#sliderImage.s" + (X + 1)).css({
            "background-image" : "url(\"" + document.getElementById("imgsrc" + (X + 1)).value + "\")",
        });
    }
}

var slideShow = setInterval(function()
{   
    if(isAnimating == 0)
    {
        if($("#overflow").css("margin-left") <= "-1800px")
        {
            $("#overflow").css(
            {
                "margin-left" : "0px"
            });
        }
        else
        {
            $("#overflow").css(
            {
                "margin-left" : "-=900px"
            });
        }
    }
    
    if($("#overflow").css("margin-left") <= "-1800px")
    {
        document.getElementById("sliderRadio1").checked = true;
    }
    else if($("#overflow").css("margin-left") >= "0px")
    {
        document.getElementById("sliderRadio2").checked = true;
    }
    else if($("#overflow").css("margin-left") <= "-900px")
    {
        document.getElementById("sliderRadio3").checked = true;
    }
    
//    alert($("#overflow").css("margin-left"));
}, 7000);

