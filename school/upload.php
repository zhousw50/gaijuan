<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>答题卡上传-改卷系统(开发中)</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css" >
        <script src="https://cdn.jsdelivr.net/npm/mdui" ></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
        <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
        <script src="/js/Loading.js"
        <script src="./header.js"></script>
    </head>
    <body style="text-align:center;">
    <style>
        @media (prefers-color-scheme: dark) {
            body {
                background: #424242;
                color: white;
            }
        }
    </style>
    <header></header>
        <script src="https://api.kinh.cc/Static/JavaScript/LoadIng.js"></script>
        <form enctype="multipart/form-data" style="display: none"><input id="file" name="file" type="file" /></form>
        <div class="mdui-col">
                <h1>1.上传一个zip压缩包,打包答题卡图片</h1><br>
                <div id="upload" class="mdui-ripple">
                    <span class="mdui-icon material-icons" style="width: 100px">cloud_upload</span>
                    <h1>选择文件</h1>
                </div>
                <br>
                <button id="submit" class="mdui-btn mdui-ripple mdui-btn-block mdui-btn-raised mdui-color-pink">上传</button>
    </div>
        <script>
        var formdata=new FormData();
        function upload()
            {
                $.ajax({
                    type: "POST",
                    url: "./proccessUploadFile.php",
                    data: formdata,
                    cache: false,
                    processData: false,
                    contentType: false,
                    timeout: 8000,
                    success: function(msg) {
                        LoadIng(false);
                        var msg1=JSON.parse(msg);
                        Swal.fire({
                            icon:msg1["type"],
                            title: msg1["msg"]
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