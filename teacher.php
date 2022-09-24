<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>改卷系统(开发中)</title>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js" ></script>
    <script src="config.js"></script>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zhousw50/tools/header.min.js"></script>
</head>

<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<div class="mdui-container mdui-card">
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
</div>
<div class="mdui-container mdui-card">
    <h2>改卷任务</h2>
<?php
foreach ($link->query("select * from exams") as $exams) {
    if ($exams["finish"] != 1) {
        $config = json_decode($exams["config"], true);
        foreach ($config["subject"] as $subjects) {
            if ($subjects == $subject) {
                echo "<div class='mdui-card-subtitle'>";
                echo "考试名:".$exams["name"]." 科目:".$subject." <a href='/view.php?exam_id=".$exams["id"]."&subject=".$subject."' target='_blank'>进入改卷</a>";
            }
        }
    }
}
?>
</div>
<script>
    header({
        color:"indigo",
        header_title:"改卷系统-教师端",
        header_link:"./"
    });
</script>
</body>
</html>