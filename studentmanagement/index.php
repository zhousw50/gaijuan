<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
?>
<html>

<head>
    <title>管理学生</title>
    <script src="https://unpkg.com/sweetalert2@11.4.19/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui/dist/css/mdui.min.css">
    <script src="https://cdn.jsdelivr.net/npm/mdui/dist/js/mdui.min.js"></script>
    <script src="/studentmanagement/index.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zhousw50/tools/header.min.js"></script>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-indigo mdui-appbar-with-toolbar mdui-appbar-with-tab-larger">
<header></header>
<div class="mdui-container mdui-card"><h1 class="mdui-card-primary-title">学生列表</h1><span class="mdui-card-primary-subtitle">每个学生学号必须唯一，学号是考试时的考号</span><div class="mdui-card-content">
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
foreach ($link->query("select * from students;")as $students){
    $i++;
    if($i%2==1)
        echo "        <tr>\n            <td class=\"mdui-color-blue\">".$students["class"]."</td>\n            <td class=\"mdui-color-blue\">".$students["id"]."</td>\n            <td class=\"mdui-color-blue\">".$students["name"]."</td>\n            <td class=\"mdui-color-blue\">".$students["pwd"]."</td>\n        </tr>\n";
    else
        echo "        <tr>\n            <td class=\"mdui-color-pink\">".$students["class"]."</td>\n            <td class=\"mdui-color-pink\">".$students["id"]."</td>\n            <td class=\"mdui-color-pink\">".$students["name"]."</td>\n            <td class=\"mdui-color-pink\">".$students["pwd"]."</td>\n        </tr>\n";
}
?>
    </table>
</div>
</div>
    </div></div>
<script>
    header({
        color:"indigo",
        header_title:"管理学生",
        header_link:"./",
        tab:3,
        tab_1_text: "添加学生",
        tab_1_link: "javascript:addstudent();",
        tab_2_text: "批量添加",
        tab_2_link: "javascript:批量();",
        tab_3_text: "删除学生",
        tab_3_link: "javascript:delstudent();",
        tab_1_img: "add",
        tab_2_img:"group_add",
        tab_3_img:"delete"
    })
</script>
</body>
</html>