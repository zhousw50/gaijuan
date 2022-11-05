<?php
include_once "../config.php";
?>
<html>

<head>
    <title>管理教师</title>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css" integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js" integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="../js/header.js"></script>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-indigo">
<button class="mdui-btn mdui-btn-raised" onclick="add()"><i class="mdui-icon material-icons">&#xe145;</i>添加教师</button>
<button class="mdui-btn mdui-btn-raised" onclick="批量()"><i class="mdui-icon material-icons">&#xe7f0;</i>批量添加</button>
<button class="mdui-btn mdui-btn-raised" onclick="del()"><i class="mdui-icon material-icons">&#xe872;</i>删除教师</button>
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
    </div></div>
<script>
    header({
        color:"indigo",
        header_title:"管理教师",
        header_link:"./",
        tab:3,
        tab_1_text: "添加教师",
        tab_1_link: "javascript:add();",
        tab_2_text: "批量添加",
        tab_2_link: "javascript:批量();",
        tab_3_text: "删除教师",
        tab_3_link: "javascript:del();",
        tab_1_img: "add",
        tab_2_img:"group_add",
        tab_3_img:"delete"
    })
</script>
</body></html>