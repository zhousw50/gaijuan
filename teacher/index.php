<?php
include_once "../config.php";
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
<div id="container">
<div class="mdui-container mdui-card mdui-p-t-3">
    <h2 class="mdui-card-primary-title">你好,<?php
        error_reporting(0);
        $subject="";
        foreach ($link->query("select * from teachers") as $teachers) {
            if ($teachers["id"] == $_COOKIE["id"]) {
                echo $teachers["name"];
                $subject = $teachers["subject"];
            }
        }
        ?>老师</h2>
</div>
<div class="mdui-container mdui-card mdui-p-t-3">
    考试:
<?php
foreach($link->query("select * from exams order by id Desc;") as $exam)
{
    $config=json_decode($exam["config"],true);
    $name=$config["exam_name"];
    $id=$config["exam_id"];
    $subjects=$config["subject"];
    foreach ($subjects as $item){
        if($item==$subject){
            echo "
    <h1 class=\"mdui-card-primary-title\"><a onclick='frame(\"exam.php?exam=$id\")'>$name</a></h1>
";
        }
    }

}
?>
</div>
</div>
    <script>
        var aaaa=1;
        function open(html){
            var empty=document.createElement("div")
            empty.id="window-"+aaaa
            empty.style+="margin: 0;padding: 0;position:absolute; top:0; bottom:0; left:0; right:0; background:white;"
            empty.innerHTML="<div style='height: 120px'></div><button  class='mdui-btn mdui-btn-raised' onclick='back()'>返回首页</button><br>"+html

            document.body.appendChild(empty)
        }
        function back(){
            document.getElementById("window-"+aaaa).remove();
            aaaa--
        }
    function frame(url){
            open("<div class=\"mdui-container mdui-card mdui-p-t-3\">\
        <iframe id=\"frame\" src=\"\" frameborder=\"0\" width=\"100%\" scrolling=\"0\"></iframe>\
        </div>")
        document.getElementById("frame").src=url;
    }
    setInterval(function (){
        document.getElementById("frame").height=window.innerHeight-200;
    },100)
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