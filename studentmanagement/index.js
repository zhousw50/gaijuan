function addstudent() {
    mdui.dialog({
        title: "添加学生",
        content: "<div class=\"mdui-textfield mdui-textfield-floating-label\">\
            <label class=\"mdui-textfield-label\">班级</label>\
            <input id=\"class\" class=\"mdui-textfield-input\"/>\
            </div>\
            <div class=\"mdui-textfield mdui-textfield-floating-label\">\
            <label class=\"mdui-textfield-label\">学号</label>\
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
                    add()
                }
            }
        ]
    })
}
function add(){
    var classs=$("#class").val();
    var id=$("#id").val();
    var name=$("#name").val();
    var pwd=$("#pwd").val();
    $.ajax({
            type: "POST",
            url: "addstudents.php",
            data: "class="+classs+"&id="+id+"&name="+name+"&pwd="+pwd,
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
function delstudent() {
    mdui.dialog({
        title: "删除学生",
        content:"<div class=\"mdui-textfield mdui-textfield-floating-label\">\
            <label class=\"mdui-textfield-label\">id</label>\
            <input id=\"id\" class=\"mdui-textfield-input\"/>\
            </div>",
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function () {
                    del()
                }
            }
        ]
    })
}
function del(){
    if(document.getElementById("id").value){
        $.ajax({
            type: "POST",
            url: "delstudents.php",
            data: "id=" + document.getElementById("id").value,
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
        });}
}
function 批量() {
    mdui.dialog({
        title: "批量添加",
        content: "<div class=\"mdui-textfield mdui-textfield-floating-label\">" +
            "<label class=\"mdui-textfield-label\">格式:每一行4个参数:班级+一个空格+学号+一个空格+姓名+一个空格+密码</label>" +
            "<textarea class=\"mdui-textfield-input\" rows=\"10\" id=\"message\"></textarea>",
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function () {
                    piliangadd()
                }
            }
        ]
    })
}
function piliangadd(){
    var message=$("#message").val();
    $.ajax({
            type: "POST",
            url: "piliangadd.php",
            data: "message=" + message,
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