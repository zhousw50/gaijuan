<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
?>
<html>
<head>
    <title>添加试卷-改卷系统(开发中)</title>
    <script src="https://unpkg.com/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css">
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js"></script>
    <script src="./header.js"></script>
    <script src="https://api.kinh.cc/Static/JavaScript/LoadIng.js"></script>
    <style>
        input{width:50px;}
    </style>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-indigo mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<div class="mdui-container mdui-card" style="text-align: center;"><h1 class="mdui-card-primary-title">试卷设置</h1>
    <div class="mdui-card-content">
        <form enctype="multipart/form-data" style="display: none"><input id="file" name="file" type="file" /></form>
        <div id="upload" class="mdui-ripple">
            <img src="https://vkceyugu.cdn.bspapp.com/VKCEYUGU-ab498c51-8871-421b-8e23-a43eaa306dff/93583d36-13e2-42f5-ab02-85effc5e6cb6.svg" width="20%"></img><br>
            <h1>点击/拖拽/粘贴上传答题卡配置文件</h1>
        </div>
        <button class="mdui-btn mdui-ripple mdui-btn-block mdui-color-pink" id="submit">添加考试</button>
    </div>
</div>

<script>
    header({
        color:"indigo",
        header_title:"添加试卷",
        header_link:""
    });
    var formdata=new FormData();
    function upload()
    {
        LoadIng(true,"正在处理数据,可能需要一段时间",400);
        //*
        $.ajax({
            type: "POST",
            url: "./proccessExamData.php",
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                LoadIng(false);
                Swal.fire({
                    title: msg
                });
            },
            error: function() {
                LoadIng(false);
                Swal.fire({
                    icon:"error",
                    title:"网络问题或不支持ajax"
                })
            }
        });//*/
    }
    document.addEventListener("paste", function (Event) {
        if (Event.clipboardData || Event.originalEvent) {
            var File = Event.clipboardData.items[0].getAsFile();
            formdata.append("file", File);
        }
    });
    $("#upload").click(function (){
        var file = document.getElementById("file");
        file.click();
        file.addEventListener("change",function () {
            if (document.getElementById("file").files[0].name != ""){
                formdata.append("file",document.getElementById("file").files[0]);
            }
        });
    });
    document.getElementById("upload").addEventListener("drop", function (Event) {
        Event.preventDefault();
        var file = Event.dataTransfer.files[0];
        formdata.append("file",file);
    });

    $("#submit").click(function(){
        upload();
    });
    document.addEventListener("dragenter", function (Event) {
        Event.preventDefault();
    });
    document.addEventListener("dragover", function (Event) {
        Event.preventDefault();
    });
</script>

</body>
</html>























<!--<div class="mdui-card-content">
模板图片url<input oninput="document.getElementById('img').setAttribute('src','./getmouse.php?img='+this.value);document.getElementById('img').setAttribute('style','width:100%;height:500px;');" class="mdui-textfield-input"><br>
<iframe id="img" frameborder="0" style="display:none;"></iframe><br>
考号<input value="" id="kaohao" style="width:25px">位数
<div id="1"></div><br>
<button class="mdui-btn mdui-ripple" onclick="addtimu()"><i class="mdui-icon material-icons">&#xe145;</i>添加题目</button>
    <button class="mdui-btn mdui-ripple" onclick="reloadList()"><i class="mdui-icon material-icons">replay</i>更新题目列表</button><br>
    <div id="2">
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable mdui-table-col-numeric">
                <thead>
                <tr>
                    <th>题号</th><th>题目类型</th><th>编辑题目</th>
                </tr>
                </thead>
                <tbody id="container">
                </tbody>
            </table>
        </div>
    </div><br>
</div>
<script>
    /*
    var timu=0;
    document.getElementById("kaohao").oninput=function (){set()}
    function set(){
        if(document.getElementById("kaohao").value>15)Swal.fire("位数太多啦").then(()=>(window.location.reload()))
        var a="";
        a += "<div class=\"mdui-table-fluid\">";
        a += "        <table class=\"mdui-table mdui-table-hoverable mdui-table-col-numeric\">";
        a += "            <tr>";
        for(var i=1;i<=document.getElementById("kaohao").value;i++)a += "                <th>第"+i+"列<\/th>";
        a += "            <\/tr>";
        for(var j=0;j<10;j++) {
            a += "            <tr>";
            for (var i = 1; i <= document.getElementById("kaohao").value; i++) a += "                <th><span>数字"+j+"<\/span>左上x:<input id='zuoshang-kaohao-"+i+"-"+j+"-x'>y:<input id='zuoshang-kaohao-"+i+"-"+j+"-y'>右下x:<input id='yousia-kaohao-"+i+"-"+j+"-x'>y:<input id='yousia-kaohao-"+i+"-"+j+"-y'><\/th>";
            a += "            <tr>";
            a += "            <\/tr>";
        }
        a += "        <\/table>";
        a += "    <\/div>";
        document.getElementById("1").innerHTML=a;
    }
    set()
    var timuarr={};
    function addtimu(){
        Swal.fire({
            icon:"info",
            title:"添加题目",
            text:"题目数量",
            input:"text",
            confirmButtonText:"添加题目"
        }).then((result)=> {
            var a='';
            for(var i=1;i<=result.value;i++){
                timu++;
                timuarr[timu]={format:"未配置题目"};
                a+='<tr><td>'+timu+'<\/td><td>'+timuarr[timu]['format']+'<\/td><\/tr>'
            }
            document.getElementById("container").innerHTML+=a;
        });
    }
    function reloadList(){
        var a='';
        document.getElementById("container").innerHTML='';
        for(var i=1;i<=timu;i++)
            a+='<tr><td>'+i+'<\/td><td>'+timuarr[i]['format']+'<\/td><td><button class="mdui-btn mdui-ripple mdui-color-pink" onclick="config('+i+')">配置题目</button><\/td><\/tr>';
        document.getElementById("container").innerHTML=a;
    }
    function config(t){
        Swal.fire({
            icon:"info",
            title:"配置第"+t+"题",
            confirmButtonText:"确定",
            html:'<sclect><option value="1"><\/option><\/select>'
        })
    }*/
</script>-->