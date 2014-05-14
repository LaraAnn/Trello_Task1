function servDisp(tO, frOm)
{
	$(tO).load(frOm);
}

function testConn(){alert("asd");}

function confirmAction(message, mode, extra)
{
    var confirmBox = confirm(message);
    if(confirmBox == true)
    {
        if(mode == 1) // cart_temp_extra.php >> replacing image queue
        {
            if($("#imageFile").val())
            {
                window.replacePixForm.submit();
            }
            else
            {
                alert('Select an image first!');
            }
        }
        else if(mode == 2)
        {
            window.location.href = "php_functions/cart_temp_extra.php?mode=delete&cart_id=" + document.getElementById("cart_id" + extra).value;
        }
        else
        {
            alert(mode);
        }
    }
    else
    {
        
    }
}

function currentPrice(wIdth, heIght, prIce, iD, paramW, paramH, pieces)
{
    var w = document.getElementById(wIdth).value, h = document.getElementById(heIght).value, perInch = prIce, total = 0;
    total = w * h * perInch;
    if(total < 120)
    {
        total = 120;
    }
    total *= document.getElementById(pieces).value;
    document.getElementById(paramW).innerHTML = w;
    document.getElementById(paramH).innerHTML = h;
    document.getElementById(iD).innerHTML = total;
    document.getElementById("totalPrice").value = total;
//    cropSize(w, h);
}

function loadPix(uRl)
{
    var dest = "url('" + uRl + "')";
    $("#imgloc").css({
        "background-image" : dest,
        "background-size" : "contain",
        "background-position" : "center",
        "background-repeat" : "no-repeat"
    });
//    alert(dest);
//    alert($("#imgloc").innerWidth());
}

function cropSize(wIdth, heIght)
{
    var containerWidth = parseInt($("#imgloc").innerHeight());
    var containerHeight = parseInt($("#imgloc").innerHeight());
    var margin = containerWidth / 2;
    
//    containerWidth += parseInt(wIdth);
    
    $("#cropimg").css({
        "width" : containerWidth,
        "height" : containerHeight,
        "margin" : "0px " + margin + "px"
    });
    
//    alert(event.pageX());
//    alert(containerWidth);
//    servDisp("#imgloc", "services_offered.html #cropimg");
}

function loadImage(iD, pAth, fileName)
{
//    var dest = "url(" + pAth + ")";
//    alert(iD + dest);
    $("#" + iD).css({
        "background-image" : "url('" + pAth + "')"
    });
    
    document.getElementById("selectedDesign").value = fileName;
}

function loadShirt(iD1, iD2)
{
    if(document.getElementById(iD2).value == 'rn')
    {
        $("#" + iD1).css({
            "background-image" : "url('images/shirtRound.jpg')"
        });
    }
    else if(document.getElementById(iD2).value == 'ps')
    {
        $("#" + iD1).css({
            "background-image" : "url('images/shirtPolo.jpg')"
        });
    }
}

function editLoadShirt(iD1, iD2)
{
    if(document.getElementById(iD2).value == 'rn')
    {
        $("#" + iD1).css({
            "background-image" : "url('../images/shirtRound.jpg')"
        });
    }
    else if(document.getElementById(iD2).value == 'ps')
    {
        $("#" + iD1).css({
            "background-image" : "url('../images/shirtPolo.jpg')"
        });
    }
}

function shirtPrice(iD1, iD2, price, totalPrice, piece)
{
    var prIce, pIece = parseInt(document.getElementById(piece).value);
    
    if(document.getElementById(iD1).value == "rn")
    {
        prIce = 280;
    }
    else if(document.getElementById(iD1).value == "ps")
    {
        if(document.getElementById(iD2).value == "small" || document.getElementById(iD2).value == "medium")
        {
            prIce = 330;
        }
        else if(document.getElementById(iD2).value == "large" || document.getElementById(iD2).value == "xl" || document.getElementById(iD2).value == "xxl")
        {
            prIce = 360;
        }
        else if(document.getElementById(iD2).value = "xxxl")
        {
            prIce = 390;
        }
    }
    document.getElementById(price).innerHTML = prIce * pIece;
    document.getElementById(totalPrice).value = prIce * pIece;
}

function cardPrice(pieces, price)
{
    var result = 0, prIce = 3;
    
    result = prIce * document.getElementById(pieces).value;
    
    document.getElementById(price).innerHTML = result;
    document.getElementById("totalPrice").value = result;
}