<?php
include_once "./config.php";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>教师端 - 改卷系统(开发中)</title>
        <script src=<?php echo $jquery_js; ?>></script>
        <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
        <script src=<?php echo $mdui_js; ?>></script>
        <script src=<?php echo $swal2_js; ?>></script>
        <script src=<?php echo $header_js; ?>></script>
        <link rel="stylesheet" href=<?php echo $waves_css; ?>>
        <link rel="stylesheet" href=<?php echo $theme_css; ?>>
    </head>
<body>
<div class="mdui-container mdui-card mdui-p-t-3">
<?php
$subject="";
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
foreach ($link->query("select * from teachers") as $teachers) {
    if ($teachers["id"] == $_COOKIE["id"]) {
        $subject = $teachers["subject"];
    }
}
$exam=$_GET["exam"];
$aaa=$link->query("select * from students;");
$class="";
foreach ($aaa as $student){
    if($student["class"]!=$class){
        echo "<button class='mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent' onclick=\"window.open('/analyseAllClass.php/class/".$student["class"]."/subject/$subject/exam/$exam');\">".$student["class"]."</button><br>";
        $student["class"]=$class;
    }
}
?>
</div>
</body>
</html>
