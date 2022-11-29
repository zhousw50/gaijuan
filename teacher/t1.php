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
<?php
        error_reporting(0);
        $subject="";
        foreach ($link->query("select * from teachers") as $teachers) {
            if ($teachers["id"] == $_COOKIE["id"]) {
                $subject = $teachers["subject"];
            }
        }
        ?>
    <h2>阅卷任务</h2>
    <h3 id="renwu"><?php
        foreach ($link->query("select * from exams where id=".$_GET["exam"]) as $exams) {
            if ($exams["finish"] != 1) {
                $config = json_decode($exams["config"], true);
                foreach ($config["subject"] as $subjects) {
                    if ($subjects == $subject) {
                        for($i=0;$i<$config[$subject]["numberOfTimu"];$i++){
                            if($config[$subject][$i]["type"]==2)
                                echo "第 $i 题<button class='mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent' onclick=\"frame('/teacher/yuejuan.php/exam/".$exams["id"]."/subject/".$subject."/timu/$i');\"> 进入改卷 </button><br>";
                        }
                    }
                }
            }
        }
        ?></h3>
<iframe frameborder="0" src="" id="frame" width="100%" scrolling="0" height="5000"></iframe>
<script>
    function frame(url){
        document.getElementById("frame").src=url;
    }
    setInterval(function (){
        document.getElementById("frame").height=window.innerHeight-120;
    },100)
    if(!document.getElementById("renwu").innerHTML)
    {
        document.getElementById("renwu").innerHTML="暂无阅卷任务";
    }
</script>
</body>
</html>