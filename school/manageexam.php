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
    for(var i=0;i<timuconfig["numberOfTimu"];i++){
        if(timuconfig[i]["type"]==0){

            e.innerHTML+="<div class='mdui-card mdui-container'><h2>" +
                "第" + i + "题</h2>类型：选择题<br>正确选项"+getchoose(timuconfig[i]["ans"])+
                "<button class='mdui-btn mdui-btn-raised' onclick='window.location.href=\"./manageTimu.php?exam=<?php echo $_GET["exam"]?>&subject=<?php echo $_GET["subject"]?>&timu="+i+"\"'>题目管理</button></div>"
        }
        if(timuconfig[i]["type"]==2){
            e.innerHTML+="<div class='mdui-card mdui-container'><h2>" +
                "第" + i + "题</h2>类型：非选题<br>"
                +"<button class='mdui-btn mdui-btn-raised' onclick='window.location.href=\"./manageTimu2.php?exam=<?php echo $_GET["exam"]?>&subject=<?php echo $_GET["subject"]?>&timu="+i+"\"'>题目管理</button>"+
                "</div>"
        }
    }
    e.innerHTML+='<div class=\'mdui-card mdui-container\'><h3>修改配置文件</h3>注意,请不要修改关于考试名称、id、科目等基本数据<textarea class="mdui-textfield-input" id="config"><?php echo $exam["config"];?></textarea><br><button onclick="submitconfig()" class="mdui-btn mdui-btn-raised">提交</button><br>'
    function submitconfig()
    {
        let config=document.getElementById("config").value;
        $.ajax({
            type:"POST",
            url:"./changeExamConfig.php",
            data:"config="+config+"&exam=<?php echo $_GET["exam"];?>",
            success:function (msg){
                Swal.fire({title:msg});
            },
            error:function (){
                Swal.fire({title:"网络问题或不支持ajax"});
            }
        })
    }
</script>
</body>