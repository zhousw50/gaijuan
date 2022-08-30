<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
?>
<!DOCTYPE html>
<html lang="en">

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
</head>

<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<div id="drawer"></div>
    <script>
        header({color:"indigo",header_title:"登录页面",header_link:"./"});
    </script>
<div class="mdui-container mdui-card"><h1 class="mdui-card-primary-title">请先登录</h1><div class="mdui-card-content">
    <script>
        var schoolname="dzzx";
        var password1="qwer";
        var password2="qwerty";
        $(document).ready(function() {
            var z=new mdui.Drawer('#main-drawer');
            z.open();
            $("#1").click(function() {
                school()
            })
            $("#2").click(function() {
                teacher()
            })
            $("#3").click(function() {
                student()
            }) 
            if (getCookie("loginas")=="school")
            window.location.href = "school.php";
            else if (getCookie("loginas")=="student")
            window.location.href="./student.php";
            else if (getCookie("loginas")=="teacher")
                window.location.href="./teacher.php";
        })
        var name1,p1,p2
        function createCookie(name,value,days,path,domain,secure) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = date.toGMTString();
            } else var expires = "";
            cookieString = name + "=" + value;
            if (expires) cookieString += ";expires=" + expires;
            if (path) cookieString += ";path=" + escape(path);
            if (domain) cookieString += ";domain=" + escape(domain);
            if (secure) cookieString += ";secure=" + escape(secure);
            document.cookie = cookieString;
        }
        function getCookie(name)
        {
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
            if(arr=document.cookie.match(reg))
                return unescape(arr[2]);
            else
                return null;
        }
        function sub() {
            name1=document.getElementById("name").value;
            p1=document.getElementById("p1").value;
            p2=document.getElementById("p2").value;
            Swal.clickConfirm()
            if(name1==schoolname&&p1==password1&&p2==password2){
                Swal.fire({icon:"success",title:"登录成功",timer:2000,showConfirmButton: false}).then(() => {
                    createCookie("loginas","school",10000);
                    window.location.reload()
                });
            }
            else {
                Swal.fire({icon:"error",title:"登录失败",timer:1000,showConfirmButton: false}).then(() => {
                    window.location.reload()
                });
            }
        }
        function school(){
        document.getElementById("login-container").innerHTML="<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">名称</label> <input class=\"mdui-textfield-input\" id='name'/> </div> </div>" +
            "<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">密码1</label> <input class=\"mdui-textfield-input\" id='p1'/> </div> </div>" +
            "<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">密码2</label> <input class=\"mdui-textfield-input\" id='p2'/> </div> </div>" +
            "<button class=\"mdui-btn mdui-btn-raised mdui-btn-block mdui-ripple\" onclick='sub()'>确定</button>";
        document.getElementById("1").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink");
        document.getElementById("2").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple");
        document.getElementById("3").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple");
        }
        function student(){
            document.getElementById("login-container").innerHTML="<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">学号</label> <input class=\"mdui-textfield-input\" id='name'/> </div> </div>" +
                "<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">密码</label> <input class=\"mdui-textfield-input\" id='pwd'/> </div> </div>" +
                "<button class='mdui-btn mdui-btn-raised mdui-btn-block mdui-ripple' onclick='submits()'>确定</button>";
            document.getElementById("3").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink");
            document.getElementById("1").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple");
            document.getElementById("2").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple");
        }
        function teacher(){
            document.getElementById("login-container").innerHTML="<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">ID</label> <input class=\"mdui-textfield-input\" id='name'/> </div> </div>" +
                "<div class=\"mdui-container\"> <div class=\"mdui-textfield mdui-textfield-floating-label\"> <label class=\"mdui-textfield-label\">密码</label> <input class=\"mdui-textfield-input\" id='pwd'/> </div> </div>" +
                "<button class='mdui-btn mdui-btn-raised mdui-btn-block mdui-ripple' onclick='submitt()'>确定</button>";
            document.getElementById("2").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink");
            document.getElementById("1").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple");
            document.getElementById("3").setAttribute('class',"mdui-btn mdui-btn-raised mdui-ripple");
        }
        function submits(){
            var id=document.getElementById('name').value;
            var pwd=document.getElementById('pwd').value;
            $.ajax({
                type:"POST",
                url:"checkStudentLogin.php",
                data:"id="+id+"&pwd="+pwd,
                success:function (ms)
                {
                    var msg=JSON.parse(ms);
                    Swal.fire({
                        icon: msg["type"],
                        title: msg["title"],
                        text: msg["msg"],
                        showConfirmButton: false,
                        timer:2000
                    }).then(() => {
                        if(msg["title"]=="登录成功"){
                            createCookie("loginas","student",10000);
                            createCookie("id",id,10000);
                            window.location.reload();
                        }
                    });
                }
            })
        }
        function submitt(){
            var id=document.getElementById('name').value;
            var pwd=document.getElementById('pwd').value;
            $.ajax({
                type:"POST",
                url:"checkTeacherLogin.php",
                data:"id="+id+"&pwd="+pwd,
                success:function (ms)
                {
                    var msg=JSON.parse(ms);
                    Swal.fire({
                        icon: msg["type"],
                        title: msg["title"],
                        text: msg["msg"],
                        showConfirmButton: false,
                        timer:2000
                    }).then(() => {
                        if(msg["title"]=="登录成功"){
                            createCookie("loginas","teacher",10000);
                            createCookie("id",id,10000);
                            window.location.reload();
                        }
                    });
                }
            })
        }
    </script>
	<button id="1" class="mdui-btn mdui-btn-raised mdui-ripple" style="width: 33%">学校管理人员</button>
	<button id="2" class="mdui-btn mdui-btn-raised mdui-ripple" style="width: 33%">老师</button>
	<button id="3" class="mdui-btn mdui-btn-raised mdui-ripple" style="width: 33%">学生</button>
        <div id="login-container"></div>
    </div></div>
</body>

</html>