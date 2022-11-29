<?php
include_once "../config.php";
?><!DOCTYPE html>
<html>
<head>
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
    <link rel="stylesheet" href=<?php echo $theme_css; ?>>
</head>
<body class="mdui-theme-layout-auto mdui-theme-primary-indigo mdui-theme-accent-pink">
<h3>选择考试</h3>
<?php
foreach ($link->query("select id,name from exams order by id Desc;") as $item)
{
    echo "<div onclick='window.location.href=\"m1.php?exam=".$item["id"]."\"' class=\"mdui-container mdui-card \"><h2>".$item["name"]."</h2></div><br>";
}
?>
</body>