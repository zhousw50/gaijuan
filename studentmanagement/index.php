<?php
include_once "../config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>管理学生</title>
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
    <link rel="stylesheet" href=<?php echo $theme_css; ?>>
    <script src="index.js"></script>
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-auto">
<style>
    @media (prefers-color-scheme: dark) {
        body {
            background: #424242;
            color:white;
        }
    }
</style>
    <button class="mdui-btn mdui-btn-raised" id="add"><i class="mdui-icon material-icons">&#xe145;</i>添加学生</button>
    <button class="mdui-btn mdui-btn-raised" id="piliang"><i class="mdui-icon material-icons">&#xe7f0;</i>批量添加</button>
    <button class="mdui-btn mdui-btn-raised" id="del"><i class="mdui-icon material-icons">&#xe872;</i>删除学生</button>
    <script>
        $("#add").on("click",function (){
            mdui.dialog({
                title:"添加学生",
                content: "<div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">班级</label><input id=\"class\" class=\"mdui-textfield-input\"/></div><div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">学号</label><input id=\"id\" class=\"mdui-textfield-input\"/></div><div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">名称</label><input id=\"name\" class=\"mdui-textfield-input\"/></div><div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">密码</label><input id=\"pwd\" class=\"mdui-textfield-input\"/></div>",
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
        })
        $("#piliang").on("click",function (){
            mdui.prompt('格式:每一行4个参数:班级+一个空格+学号+一个空格+姓名+一个空格+密码','批量添加',function (val){
                if(val) piliangadd(val)
            },{
                type:"textarea",
                confirmText:"确认",
                cancelText:"取消"
            })
        })
        $("#del").on("click",function (){
            mdui.prompt('id','删除学生',function (val){
                if(val) del(val)
            },{confirmText:"确认",cancelText:"取消"})
        })
    </script>
    <h1>学生列表</h1>
    <span class="mdui-card-primary-subtitle">每个学生学号必须唯一，学号是考试时的考号</span>
    <div class="mdui-card-content">
        <div id="container">
            <div class="mdui-table-fluid">
                <table class="mdui-table mdui-table-hoverable mdui-table-col-numeric">
                    <tr>
                        <th>班级</th>
                        <th>学号</th>
                        <th>名称</th>
                        <th>密码</th>
                    </tr><?php
                    echo "\n";
                    $i=0;
            foreach ($link->query("select * from students;")as $students){
                $i++;
                if($i%2==1)
                    echo "            <tr>\n              <td class=\"mdui-color-blue\">".$students["class"]."</td>\n              <td class=\"mdui-color-blue\">".$students["id"]."</td>\n              <td class=\"mdui-color-blue\">".$students["name"]."</td>\n              <td class=\"mdui-color-blue\">".$students["pwd"]."</td>\n          </tr>\n";
                else
                    echo "            <tr>\n              <td class=\"mdui-color-pink\">".$students["class"]."</td>\n              <td class=\"mdui-color-pink\">".$students["id"]."</td>\n              <td class=\"mdui-color-pink\">".$students["name"]."</td>\n              <td class=\"mdui-color-pink\">".$students["pwd"]."</td>\n          </tr>\n";
            }
            ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>