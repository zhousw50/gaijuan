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
        $link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
        foreach ($link->query("select * from teachers") as $teachers){
            if($teachers["id"]==$_COOKIE["id"])echo $teachers["name"];
        }
        ?>老师</h1>
</div>
<?php
foreach ($link->query("select * from exams") as $exams){

}
?>
<script>
    header({
        color:"indigo",
        header_title:"改卷系统-教师端",
        header_link:"./"
    });
</script>
</body>
</html>