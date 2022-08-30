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
    <title>改卷系统(开发中)</title>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js" ></script>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zhousw50/tools/header.js"></script>
    <link rel="stylesheet" href="https://burgerstudio.github.io/waves/waves.min.css">
    <link rel="stylesheet" href="https://burgerstudio.github.io/theme.css">
    <meta name="viewport" content="width=device-width">
</head>
<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<div class="mdui-container mdui-p-t-3">
    <div class="mdui-row">
        <div class="mdui-col">
            <img id="photo" class="mdui-col-xs-11 mdui-col-offset-xs-2" src="http://g.zhousw.top/upload/bbd8d01c9bb461bbbdc958ae77497b56/1.jpeg">
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
                        <button id="submit" class="mdui-btn mdui-btn-raised mdui-ripple">确定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var msg;
    function gettimu(){
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
                Swal.fire({html:msg1})
                    msg=msg1;
            },
            error:function (){
                    document.getElementsByTagName("body")[0].innerHTML="<h1>网络问题或不支持ajax</h1>"
                document.getElementsByTagName("body")[0].removeAttribute("class");
            }
        });
    }
    gettimu()
    setTimeout("a()",1000)
    function a() {
        //*
        document.getElementById("photo").setAttribute("src", timu["photo"]);
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        document.getElementById("point").oninput = function () {
            if (this.value > timu["max_point"]) {
                hasError = true;
            } else {
                hasError = false;
            }
            if (hasError) {
                document.getElementById("error").removeAttribute("hidden");
                document.getElementById("error").innerHTML = "数字太大啦"
            } else {
                document.getElementById("error").setAttribute("hidden", "true");
            }
        }
    }
    header({color:"indigo",header_title:"阅卷页面",header_link:""});//*/
</script>
</body>
</html>