<?php
include_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
    <link rel="stylesheet" href=<?php echo $theme_css; ?>>
</head>

<body class="mdui-theme-layout-auto mdui-theme-primary-indigo mdui-theme-accent-pink">
<button class="mdui-btn">
    <a onclick="frame('t1.php?exam=<?php echo $_GET["exam"];?>');" class="mdui-ripple mdui-bottom-nav-active">
        <i class="mdui-icon material-icons">wallpaper</i>
        <label>阅卷</label>
    </a>
</button>
<button class="mdui-btn">
    <a onclick="frame('t2.php?exam=<?php echo $_GET["exam"];?>')" class="mdui-ripple mdui-bottom-nav-active">
        <i class="mdui-icon material-icons">class</i>
        <label>查看成绩</label>
    </a>
</button>
<iframe frameborder="0" src="" id="frame" width="100%" scrolling="0"></iframe>
<script>
    function frame(url){
        document.getElementById("frame").src=url;
    }
    setInterval(function (){
        document.getElementById("frame").height=window.innerHeight-100;
    },100)
    frame('t1.php?exam=<?php echo $_GET["exam"];?>');
    if(!document.getElementById("renwu").innerHTML)
    {
        document.getElementById("renwu").innerHTML="暂无改卷任务";
    }
</script>
</body>
</html>