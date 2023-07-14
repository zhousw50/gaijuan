function add(){
    var classs=$("#class").val();
    var id=$("#id").val();
    var name=$("#name").val();
    var pwd=$("#pwd").val();
    $.ajax({
            type: "POST",
            url: "add.php",
            data: "class="+classs+"&id="+id+"&name="+name+"&pwd="+pwd,
        success: function(msg) {
            Swal.fire({
                icon: "success",
                title: msg=="操作成功"?"操作成功":"操作失败",
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
function del(id){
        $.ajax({
            type: "POST",
            url: "del.php",
            data: "id=" + id,
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
function piliangadd(message){
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