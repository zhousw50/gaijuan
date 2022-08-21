        function add()
        {
            Swal.fire({
                showCancelButton:true,
                showConfirmButton: false,
                icon:"info",
                title:"添加教师",
                html:"<div class=\"mdui-textfield mdui-textfield-floating-label\">\
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
        </div>\
        <button type=\"button\" class=\"swal2-confirm swal2-styled\" aria-label style=\"display: inline-block;\" onclick=\"add2()\">添加教师</button>",
        
                cancelButtonText:'取消'
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
        function del()
        {
            Swal.fire({
                icon:"info",
                title:"删除教师",
                text:"输入ID",
                input:"text",
                confirmButtonText:'删除教师',
                showCancelButton:true,
                cancelButtonText:'取消'
            }).then((result)=>{
                if(result.value)
                {
                    $.ajax({
                    type: "POST",
                    url: "del.php",
                    data: "id="+result.value,
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
            })
        }
        function 批量()
        {
            Swal.fire({
                showCancelButton:true,
                showConfirmButton: false,
                icon:"info",
                title:"批量添加",
                html:"<div class=\"mdui-textfield mdui-textfield-floating-label\">\
                <label class=\"mdui-textfield-label\">格式:每一行4个参数:科目+一个空格+ID+一个空格+姓名+一个空格+密码</label>\
                <textarea class=\"mdui-textfield-input\" rows=\"10\" id=\"message\"></textarea>\
                <button type=\"button\" class=\"swal2-confirm swal2-styled\" aria-label style=\"display: inline-block;\" onclick=\"piliangadd()\">批量添加</button>",
                
                cancelButtonText:'取消'
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