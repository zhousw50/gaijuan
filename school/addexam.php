<?php
include_once "../config.php";
?>
<html>
<head>
    <title>添加试卷-改卷系统(开发中)</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css">
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/LoadIng.js"></script>
    <style>
        input{width:50px;}
    </style>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-indigo mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<div style="text-align: center;">
    <div class="mdui-card-content">
        <form enctype="multipart/form-data" style="display: none"><input id="file" name="file" type="file" /></form>
        <div id="upload" class="mdui-ripple">
            <img src="https://vkceyugu.cdn.bspapp.com/VKCEYUGU-ab498c51-8871-421b-8e23-a43eaa306dff/93583d36-13e2-42f5-ab02-85effc5e6cb6.svg" width="20%"></img><br>
            <h1>点击/拖拽/粘贴上传答题卡配置文件</h1>
        </div>
        <button class="mdui-btn mdui-ripple mdui-btn-block mdui-btn-raised mdui-color-pink" id="submit">添加考试</button>
    </div>
</div>

<script>
    var formdata=new FormData();
    function upload()
    {
        LoadIng(true,"正在处理数据,可能需要一段时间",350);
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