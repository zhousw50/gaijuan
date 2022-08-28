<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>图片上传</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css" >
        <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
        <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    </head>
    <body class="mdui-theme-primary-indigo mdui-theme-accent-indigo" style="text-align:center;">
        <script src="https://api.kinh.cc/Static/JavaScript/LoadIng.js"></script>
        <form enctype="multipart/form-data" style="display: none"><input id="file" name="file" type="file" /></form>
        <h1>上传一个zip压缩包,打包图片</h1><br>
        
        <div id="upload" class="mdui-ripple">
            <img src="https://vkceyugu.cdn.bspapp.com/VKCEYUGU-ab498c51-8871-421b-8e23-a43eaa306dff/93583d36-13e2-42f5-ab02-85effc5e6cb6.svg" width="30%"></img><br>
            <h1>选择文件</h1>
        </div>
        <br>
        <button id="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-active">上传</button>
        <script>
        var formdata=new FormData();
        function upload()
            {
                $.ajax({
                    type: "POST",
                    url: "upload.php",
                    data: formdata,
                    cache: false,
                    processData: false,
                    contentType: false,
                    timeout: 8000,
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
                 });
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
            document.addEventListener("drop", function (Event) {
                Event.preventDefault();
                var file = Event.dataTransfer.files[0];
                formdata.append("file",file);
            });
            
            $("#submit").click(function(){
                LoadIng(true,"正在上传文件",220);
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