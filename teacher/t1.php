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

<body class="mdui-theme-layout-auto mdui-theme-primary-indigo mdui-theme-accent-pink">
<?php
        error_reporting(0);
        $subject="";
        $link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
        foreach ($link->query("select * from teachers") as $teachers) {
            if ($teachers["id"] == $_COOKIE["id"]) {
                $subject = $teachers["subject"];
            }
        }
        ?>
<div class="mdui-container mdui-card">
    <h2>改卷任务</h2>
    <h3 id="renwu"><?php
        foreach ($link->query("select * from exams") as $exams) {
            if ($exams["finish"] != 1) {
                $config = json_decode($exams["config"], true);
                foreach ($config["subject"] as $subjects) {
                    if ($subjects == $subject) {
                        for($i=0;$i<$config[$subject][0]["numberOfTimu"];$i++){
                            if($config[$subject][0][$i][0]["type"]==2)
                                echo "考试名:".$exams["name"]." 科目:".$subject." 第 $i 题<button class='mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent' onclick=\"window.open('/yuejuan.php/exam/".$exams["id"]."/subject/".$subject."/timu/$i');\"> 进入改卷 </button><br>";
                        }
                    }
                }
            }
        }
        ?></h3>
</div>
<script>
    if(!document.getElementById("renwu").innerHTML)
    {
        document.getElementById("renwu").innerHTML="暂无改卷任务";
    }
</script>
</body>
</html>