<?php
include_once "../config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>管理教师</title>
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
        }
    }
</style>
    <button class="mdui-btn mdui-btn-raised" id="add"><i class="mdui-icon material-icons">&#xe145;</i>添加教师</button>
    <button class="mdui-btn mdui-btn-raised" id="piliang"><i class="mdui-icon material-icons">&#xe7f0;</i>批量添加</button>
    <button class="mdui-btn mdui-btn-raised" id="del"><i class="mdui-icon material-icons">&#xe872;</i>删除教师</button>
    <script>
        $("#add").on("click",function (){
            mdui.dialog({
                title:"添加教师",
                content:"<div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">科目</label><input id=\"subject\" class=\"mdui-textfield-input\"/></div><div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">ID</label><input id=\"id\" class=\"mdui-textfield-input\"/></div><div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">名称</label><input id=\"name\" class=\"mdui-textfield-input\"/></div><div class=\"mdui-textfield mdui-textfield-floating-label\"><label class=\"mdui-textfield-label\">密码</label><input id=\"pwd\" class=\"mdui-textfield-input\"/></div>",
                buttons:[
                    {text: '取消'},
                    {
                        text: '确认',
                        onClick: function () {
                            var a=$("#subject").val();
                            var b=$("#id").val();
                            var c=$("#name").val();
                            var d=$("#pwd").val();
                            if(a&&b&&c&&d) add();
                        }
                    }
                ]
            })
        })
        $("#piliang").on("click",function (){
            mdui.prompt('格式:每一行4个参数:科目+一个空格+ID+一个空格+姓名+一个空格+密码','批量添加',function (val){
                if(val) piliangadd(val)
            },{type:"textarea",confirmText:"确认",cancelText:"取消"})
        })
        $("#del").on("click",function (){
            mdui.prompt('id','删除教师',function (val){
                if(val) del(val)
            },{confirmText:"确认",cancelText:"取消"})
        })
    </script>
</div>
<h1 class="mdui-card-primary-title">教师列表</h1><div class="mdui-card-content">
    <div class="mdui-table-fluid">
        <table class="mdui-table mdui-table-hoverable mdui-table-col-numeric">
            <tr>
                <th>科目</th>
                <th>ID</th>
                <th>名称</th>
                <th>密码</th>
            </tr>
<?php
echo "\n";
$i=0;
foreach($link->query("select * from teachers;") as $teachers){
    $i++;
    if($i%2==1)
        echo "            <tr>\n                <td class=\"mdui-color-blue\">".$teachers["subject"]."</td>\n                <td class=\"mdui-color-blue\">".$teachers["id"]."</td>\n                <td class=\"mdui-color-blue\">".$teachers["name"]."</td>\n                <td class=\"mdui-color-blue\">".$teachers["pwd"]."</td>\n            </tr>";
    else
        echo "            <tr>\n                <td class=\"mdui-color-pink\">".$teachers["subject"]."</td>\n                <td class=\"mdui-color-pink\">".$teachers["id"]."</td>\n                <td class=\"mdui-color-pink\">".$teachers["name"]."</td>\n                <td class=\"mdui-color-pink\">".$teachers["pwd"]."</td>\n            </tr>";
}
echo "\n";
?>
        </table>
    </div>
    </div>
</div>
</div>
<script src="index.js"></script>
<script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>
</html>