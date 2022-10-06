<?php
include_once "./config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>教师端 - 改卷系统(开发中)</title>
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
    <h1 class="mdui-card-primary-title">你好,<?php
        error_reporting(0);
        $subject="";
        $link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
        foreach ($link->query("select * from teachers") as $teachers) {
            if ($teachers["id"] == $_COOKIE["id"]) {
                echo $teachers["name"];
                $subject = $teachers["subject"];
            }
        }
        ?>老师</h1>
    <select class="mdui-select" mdui-select>
        <option value="1">State 1</option>
        <option value="2">State 2</option>
        <option value="3" disabled>State 3</option>
        <option value="4">State 4</option>
        <option value="5">State 5</option>
        <option value="6">State 6</option>
    </select>
</div>
<iframe frameborder="0" src="" id="frame" width="100%" height="100%"></iframe>
<div class="mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-brown mdui-bottom-nav-fixed">
    <a onclick="frame('t1.php');" class="mdui-ripple mdui-bottom-nav-active">
        <i class="mdui-icon material-icons">wallpaper</i>
        <label>阅卷</label>
    </a>
    <a onclick="frame('t2.php?exam=1')" class="mdui-ripple mdui-bottom-nav-active">
        <i class="mdui-icon material-icons">class</i>
        <label>查看成绩</label>
    </a>
</div>
<script>
    function frame(url){
        document.getElementById("frame").src=url;
    }
    frame("t1.php");
    header({
        color:"indigo",
        header_title:"改卷系统-教师端",
        header_link:"./"
    });
    if(!document.getElementById("renwu").innerHTML)
    {
        document.getElementById("renwu").innerHTML="暂无改卷任务";
    }
</script>
</body>
</html>