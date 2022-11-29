<?php
include_once "../config.php"
?><!DOCTYPE html>
<html>
<head>
    <title>学校管理员页面</title>
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
    <link rel="stylesheet" href=<?php echo $theme_css; ?>>
</head>
<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab mdui-theme-layout-auto mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header></header>
    <div class="mdui-container mdui-card mdui-p-t-3">
        <button class="mdui-btn mdui-btn-raised" onclick="frame('../studentmanagement/')">管理学生</button>
        <button class="mdui-btn mdui-btn-raised" onclick="frame('../teachermanagement/')">管理教师</button>
        <button class="mdui-btn mdui-btn-raised" onclick="frame('./addexam.php')">添加考试</button>
        <button class="mdui-btn mdui-btn-raised" onclick="frame('./choose.php')">管理考试</button><br>
        <div style="height: 5px;width: 100%"></div>
        <iframe frameborder="0" src="" id="frame" width="100%" scrolling="0"></iframe>
    </div>
    <script>
        header({color:"indigo",header_title:"学校管理员页面",header_link:"./"})
        function frame(url){
            document.getElementById("frame").src=url;
        }
        setInterval(function (){
            document.getElementById("frame").height=window.innerHeight-200;
        },100)
    </script>
</body>
</html>
