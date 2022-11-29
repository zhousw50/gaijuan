<?php
include_once "../config.php";
?><!DOCTYPE html>
<html>
<head>
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
    <link rel="stylesheet" href=<?php echo $theme_css; ?>>
</head>
<body class="mdui-theme-layout-auto mdui-theme-primary-indigo mdui-theme-accent-pink">
<button class="mdui-btn" onclick="window.history.go(-1);">回到上一页</button>
<div class="mdui-container mdui-card" id="container"></div>
<script>
    function getchoose(choose){
        switch (choose){
            case 1:
                return "A"
            case 2:
                return "B"
            case 3:
                return "C"
            case 4:
                return "D"
            case 5:
                return "E"
            case 6:
                return "F"
            case 7:
                return "G"
        }
    }
    var j1='<?php
        $a=$link->query("select * from exams where id=".$_GET["exam"]);
        $exam=$a->fetch();
        $config=json_decode($exam["config"],true);
        $dtk=$config[$_GET["subject"]][0];
        $b=$link->query("select * from ".$_GET["exam"]."_".$_GET["subject"].";");
        $data=$b->fetchAll();
        echo json_encode($config)
        ?>';
    var j2='<?php echo json_encode($data)?>';
    var config=JSON.parse(j1);
    var data=JSON.parse(j2);
    var e=document.createElement("div");
    e.setAttribute("id","container")
    document.body.appendChild(e);
    var timuconfig=config["<?php echo $_GET["subject"]?>"];
    var timu=timuconfig["<?php echo $_GET["timu"]?>"];
    var ctn=document.getElementById("container");
    var a=0;
    for(var i=0;i<data.length;i++){
        if(timu["ans"]===data[i]["timu_<?php echo $_GET["timu"]?>"]){
            a++;
            console.log(a);
        }
    }
    ctn.innerHTML+="<h2>第<?php echo $_GET["timu"]?>题</h2>全级正确率"+a/data.length*100+"%";
    var j3='<?php
        $p=$link->query("select * from students;");
        echo json_encode($p->fetchAll());
         ?>';
    console.log(JSON.parse(j3));
</script>
</body>