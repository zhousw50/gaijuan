        function add()
        {
            mdui.dialog({
                title:"添加教师",
                content:"<div class=\"mdui-textfield mdui-textfield-floating-label\">\
        <label class=\"mdui-textfield-label\">科目</label>\
        <input id=\"subject\" class=\"mdui-textfield-input\"/>\
        </div>\
        <div class=\"mdui-textfield mdui-textfield-floating-label\">\
        <label class=\"mdui-textfield-label\">ID</label>\
        <input id=\"id\" class=\"mdui-textfield-input\"/>\
        </div>\
        <div class=\"mdui-textfield mdui-textfield-floating-label\">\
        <label class=\"mdui-textfield-label\">名称</label>\
        <input id=\"name\" class=\"mdui-textfield-input\"/>\
        </div>\
        <div class=\"mdui-textfield mdui-textfield-floating-label\">\
        <label class=\"mdui-textfield-label\">密码</label>\
        <input id=\"pwd\" class=\"mdui-textfield-input\"/>\
        </div>",
                buttons: [
                    {
                        text: '取消'
                    },
                    {
                        text: '确认',
                        onClick: function () {
                            add2()
                        }
                    }
                ]
            })
        }
        function add2()
        {
            var subject=$("#subject").val();
            var id=$("#id").val();
            var name=$("#name").val();
            var pwd=$("#pwd").val();
            $.ajax({
                    type: "POST",
                    url: "add.php",
                    data: "subject="+subject+"&id="+id+"&name="+name+"&pwd="+pwd,
                    success: function(msg) {
                        Swal.fire({
                            icon: "success",
                            title: msg,
                            showConfirmButton: false,
                            timer:1000
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon:"error",
                            title:"网络问题或不支持ajax",
                            showConfirmButton: false,
                            timer:1000
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
        }
        function del2(){
            $.ajax({
                type: "POST",
                url: "del.php",
                data: "id="+document.getElementById("id").value,
                success: function(msg) {
                    Swal.fire({
                        icon: "success",
                        title: msg,
                        showConfirmButton: false,
                        timer:1000
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        icon:"error",
                        title:"网络问题或不支持ajax",
                        showConfirmButton: false,
                        timer:1000
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
        function del()
        {
            mdui.dialog({
                title:"删除教师",
                content:"<div class=\"mdui-textfield mdui-textfield-floating-label\">\
            <label class=\"mdui-textfield-label\">id</label>\
            <input id=\"id\" class=\"mdui-textfield-input\"/>\
            </div>",
                buttons: [
                    {text: '取消'},
                    {text: '确认', onClick: function () {del2()}}
                ]
            })
        }
        function 批量()
        {
            mdui.dialog({
                title:"批量添加",
                content:"<div class=\"mdui-textfield mdui-textfield-floating-label\">\
                <label class=\"mdui-textfield-label\">格式:每一行4个参数:科目+一个空格+ID+一个空格+姓名+一个空格+密码</label>\
                <textarea class=\"mdui-textfield-input\" rows=\"10\" id=\"message\"></textarea>",
                buttons: [{text: '取消'}, {text: '确认', onClick: function () {piliangadd()}}]
            })
        }
        function piliangadd(){
            var message=$("#message").val();
            $.ajax({
                    type: "POST",
                    url: "piliang.php",
                    data: "message="+message,
                    success: function(msg) {
                        Swal.fire({
                            icon: "success",
                            title: msg,
                            showConfirmButton: false,
                            timer:1000
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon:"error",
                            title:"网络问题或不支持ajax",
                            showConfirmButton: false,
                            timer:1000
                        }).then(() => {
                            window.location.reload();
                        });
                    }
            });
        }