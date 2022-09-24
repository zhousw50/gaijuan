<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>学生端-改卷系统(开发中)</title>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js" ></script>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="/header.js"></script>
</head>

<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<div class="mdui-container mdui-card">
    <h1 class="mdui-card-primary-title">你好,<?php
        $url=$_SERVER['REQUEST_URI'];
        $arr=explode("/",$url);
        $arr1=array();
        $number=1;
        foreach($arr as $a){
            $number++;
        }
        for($i=2;$i<=$number-2;$i++)
        {
            $arr1[$i-2]=$arr[$i];
        }
        for($i=0;$i<$number-3;$i++){
            if($arr1[$i]=="exam")$examid=$arr1[$i+1];
        }
        //error_reporting(0);
        $link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
        foreach ($link->query("select * from students") as $students){
            if($students["id"]==$_COOKIE["id"])echo $students["name"];
        }
        ?>同学,这里是您的<?php
        $exam=array();
        foreach ($link->query("select * from exams") as $exams){
            if($exams["id"]==$examid){
                echo $exams["name"];
                $exam=$exams;
            }
        }
        ?>考试成绩
    </h1>
    <div class="mdui-card-container">
        <div class="mdui-primary-card-title">
        <?php
        $config=json_decode($exam["config"],true);
        foreach($config["subject"] as $item)
        {
            echo "<h1 style='text-align: center'>$item:";
            $score=0;
            $prepare=$link->prepare("select * from ".$examid."_"."$item where id=".$_COOKIE["id"]);
            $prepare->execute();
            $a=$prepare->fetch();
            for($i=0;$i<$config[$item][0]["numberOfTimu"];$i++){
                $timuconfig=$config[$item][0][$i][0];
                if($timuconfig["type"]==0){
                    if($a["timu_$i"]==$timuconfig["ans"]){
                        $score+=$timuconfig["point"];
                    }
                }
                if($timuconfig["type"]==2){
                    settype($a["timu_$i"],"float");
                    $score+=$a["timu_$i"];
                }
            }
            echo "$score 分</h1>";
        }
        ?>
        </div>
    </div>
</div>
<script>
    header({
        color:"indigo",
        header_title:"改卷系统-学生端",
        header_link:"/"
    });
</script>
</body>
</html>
