<!DOCTYPE html>
<html lang="ZH-cn">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>
<body>
    <input id="url"><button onclick="photo()">显示</button><br>
    <img id="img"><br>
    <span style="background-color:#3c62ec;text-shadow:4px;border-radius:5px; width:60px;height:50px;#3c62ec;position:absolute;left:0px;top:0px;text-align:center" id="mouse" hidden="true"></div>
<script>
function photo() {
    $("#img").attr("src", document.getElementById("url").value);
}
function getX(){
    var event = event || window.event;
    if (event.offsetX || event.offsetY)return event.offsetX;
    else if (event.layerX || event.layerY) return event.layerX;
}
function getY(){
    var event = event || window.event;
    if (event.offsetX || event.offsetY)return event.offsetY;
    else if (event.layerX || event.layerY) return event.layerY;
}
var x,y;
function sub() {
    Swal.clickConfirm()
    Swal.fire("x="+x+"y="+y)
}
function getQueryVariable(variable)
{
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}
var kaohao,i=0;
var div = document.getElementById("img");
var div1 = document.getElementById("mouse");
$("#img").mouseleave(function(){
        $("#mouse").attr("hidden",true);
});
div.onmousemove =function (){get()}
function get() {
        x=getX();
        y=getY();
        $("#mouse").attr("hidden",false);
        $("#mouse").html("x:"+x+"<br>y:"+y);
        if(x<=70){div1.style.left = 0 + "px";div1.style.top = y-70 + "px";if(y<=70){div1.style.left =0 + "px";div1.style.top = 0 + "px";}}
        else if(y<=70){div1.style.left = x-70 + "px";div1.style.top = 0 + "px";}
        else{div1.style.left = x-70 + "px";
        div1.style.top = y-70 + "px";}
}
</script>/body>
</html>