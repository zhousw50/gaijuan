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
        if(data[i]["timu_<?php echo $_GET["timu"]?>"]){
            a+=Number(data[i]["timu_<?php echo $_GET["timu"]?>"]);
        }
    }
    ctn.innerHTML+="<h2>第<?php echo $_GET["timu"]?>题</h2>全级平均分"+a/data.length+"分";
    var j3='<?php
        $p=$link->query("select * from students;");
        echo json_encode($p->fetchAll());
         ?>';
    ctn.innerHTML+="<button class='mdui-btn mdui-btn-raised' onclick='rejudgeAll()'>全部重评</button><br><button class='mdui-btn mdui-btn-raised' onclick='rejudge()'>部分重评</button>";
    console.log(data);
    function rejudgeAll(){
        Swal.fire({
            icon:"info",
            title:"确认全部重评?",
            showConfirmButton:true,
            showCancelButton:true,
            confirmButtonText:"确定",
            cancelButtonText:"取消"
        }).then((isConfirm)=>{
            if(isConfirm){
                $.ajax({
                    type:"post",
                    data:"exam=<?php echo $_GET["exam"]?>&subject=<?php echo $_GET["subject"]?>&timu=<?php echo $_GET["timu"]?>",
                    url:"./rejudgeAll.php",
                    success:function (msg){
                        Swal.fire({
                            title:msg
                        })
                    }
                })
            }
        })
    }
    function rejudge(){
        Swal.fire({
            icon:"info",
            title:"请输入需重评此题的学生考号",
            showConfirmButton:true,
            showCancelButton:true,
            confirmButtonText:"确定",
            cancelButtonText:"取消",
            html:"<div class=\"mdui-textfield mdui-textfield-floating-label\">" +
                "   <label class=\"mdui-textfield-label\">请输入考号，一个隔一行</label>" +
                "   <textarea class=\"mdui-textfield-input\" rows=\"10\" id=\"message\">" +
                "</textarea>"
        }).then((isConfirm)=>{
            if(isConfirm){
                $.ajax({
                    type:"post",
                    data:"exam=<?php echo $_GET["exam"]?>&subject=<?php echo $_GET["subject"]?>&timu=<?php echo $_GET["timu"]?>"+"&message="+
                    //console.log(
                        document.getElementById("message").value
                    //)
                ,
                    url:"./rejudge.php",
                    success:function (msg){
                        Swal.fire({
                            icon:!msg?"success":"error",
                            title:!msg?"操作成功":"操作失败"
                        })
                    }
                })
            }
        })
    }
</script>
</body>