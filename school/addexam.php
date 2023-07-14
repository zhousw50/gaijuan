<?php
include_once "../config.php";
?>
<html>
<head>
    <title>添加试卷-改卷系统(开发中)</title>
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
    <link rel="stylesheet" href=<?php echo $theme_css; ?>>
    <script src=<?php echo $loadIng_js; ?>></script>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
<style>
@media (prefers-color-scheme: dark) {
    body {
        background: #424242;
        color:white;
    }
}
</style>
<iframe frameborder="0" width="100%" scrolling="0" id="frame"></iframe>
<div style="text-align: center;">
    <div class="mdui-card-content">
        <h1>2.上传答题卡配置文件</h1>
        <form enctype="multipart/form-data" style="display: none"><input id="file" name="file" type="file" /></form>
        <div id="upload" class="mdui-ripple">
            <span class="mdui-icon material-icons" style="width: 100px">cloud_upload</span>
            <h1>选择文件</h1>
        </div>
        <button class="mdui-btn mdui-ripple mdui-btn-block mdui-btn-raised mdui-color-pink" id="submit">添加考试</button>
    </div>
</div>
<script>
    function frame(url){
        document.getElementById("frame").src=url;
    }
    setInterval(function (){
        document.getElementById("frame").height=window.innerHeight-200;
    },100)
    frame("upload.php");
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
                    title: !msg?"操作成功":msg
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