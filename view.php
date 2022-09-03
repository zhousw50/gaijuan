<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
if(!$_GET["exam_id"]&&!$_GET["timu"])echo "<script>window.location.href='./';</script>";
else{
    $exam_id=$_GET["exam_id"];
    $timu=$_GET["timu"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>阅卷-改卷系统(开发中)</title>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js" ></script>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zhousw50/tools/header.js"></script>
    <link rel="stylesheet" href="https://burgerstudio.github.io/waves/waves.min.css">
    <link rel="stylesheet" href="https://burgerstudio.github.io/theme.css">
    <meta name="viewport" content="width=device-width">
</head>
<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
<header></header>
<div class="mdui-container mdui-p-t-3 mdui-col-xs-8 mdui-col-offset-xs-3">
    <div class="mdui-col">
        <div class="mdui-card">
            <img id="photo" class="mdui-img-fluid">
        </div>
    </div>
</div>
<div class="mdui-container mdui-p-t-3">
    <div class="mdui-row">
        <div class="mdui-col">
            <div style="position:fixed; top:140px; left:20px;" class="mdui-card mdui-card-content mdui-col-xs-2">
                <div class="mdui-card-primary">
                    <div class="mdui-card-primary-title">给分版</div>
                    <div class="mdui-card-primary-subtitle">请输入分数</div>
                </div>
                <div class="mdui-card-content">
                    <div class="mdui-textfield mdui-textfield-floating-label">
                        <label class="mdui-textfield-label">分数</label>
                        <input class="mdui-textfield-input" id="point"/>
                        <span style="color: red;" id="error"></span><br>
                        <button id="submit" class="mdui-btn mdui-btn-raised mdui-ripple" disabled>确定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    header({color:"indigo",header_title:"阅卷页面",header_link:""});
    document.body.scrollTop = document.documentElement.scrollTop = 0;
    document.getElementById("point").oninput = function () {
        if (this.value > msg["max_point"]) {
            hasError = true;
        } else {
            hasError = false;
        }
        if(!this.value)document.getElementById("submit").setAttribute("disabled","true");
        if (hasError) {
            document.getElementById("error").removeAttribute("hidden");
            document.getElementById("error").innerHTML = "数字太大啦,请重新输入";
            document.getElementById("submit").setAttribute("disabled","true");
        } else {
            document.getElementById("error").setAttribute("hidden", "true");
            document.getElementById("submit").removeAttribute("disabled");
            if(!this.value)document.getElementById("submit").setAttribute("disabled","true");
        }
    }
    var msg,id;
    $.ajax({
        type:"POST",
        url:"./getTimu.php",
        data:"<?php
            if(!$_GET["exam_id"]&&!$_GET["timu"]){
                header('Refresh: 0; url=./');
            }
            else{
                $exam_id=$_GET["exam_id"];
                $timu=$_GET["timu"];
                $subject=$_GET["subject"];
                echo "exam_id=$exam_id&timu=$timu&subject=$subject";
            }
            ?>",
        success:function (msg1){
            msg=JSON.parse(msg1);
            var a=Math.floor(Math.random()*msg["number"]);
            id=msg["id"][a]
            document.getElementById("photo").src=msg[id]["photo"];
        },
        error:function (){
            document.getElementsByTagName("body")[0].innerHTML="<h1>网络问题或不支持ajax</h1>"
            document.getElementsByTagName("body")[0].removeAttribute("class");
        }
    });
    document.getElementById("submit").onclick=function (){
        Swal.fire({
            icon:document.getElementById("point").value?"success":"error",
            title:document.getElementById("point").value?"+"+document.getElementById("point").value:"您没给分",
            timer:800,
            showConfirmButton:false,
            toast: true,
            position: 'top-end'
        });
        
    }
</script>
</body>
</html>
