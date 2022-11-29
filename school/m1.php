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
<?php
$a=$link->query("select * from exams where id=".$_GET["exam"]);
$exam=$a->fetch();
$config=json_decode($exam["config"],true);
foreach ($config["subject"] as $item){
    echo "<div onclick='window.location.href=\"manageexam.php?exam=".$_GET["exam"]."&subject=".$item."\"' class=\"mdui-container mdui-card\"><h3>$item</h3></div>";
}
?>
</body>