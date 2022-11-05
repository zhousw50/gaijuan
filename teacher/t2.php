<?php
include_once "../config.php";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <script src=<?php echo $jquery_js; ?>></script>
        <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
        <script src=<?php echo $mdui_js; ?>></script>
        <script src=<?php echo $swal2_js; ?>></script>
        <script src=<?php echo $header_js; ?>></script>
        <link rel="stylesheet" href=<?php echo $waves_css; ?>>
        <link rel="stylesheet" href=<?php echo $theme_css; ?>>
    </head>
<body>选择班级
<?php
$subject="";
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
        echo "<button class='mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent' onclick=\"frame('./analyseAllClass.php/class/".$student["class"]."/subject/$subject/exam/$exam');\">".$student["class"]."</button>";
        $student["class"]=$class;
    }
}
?><br><br><br>
<iframe frameborder="0" src="" id="frame" width="100%" scrolling="0"></iframe>
<script>
    function frame(url){
        document.getElementById("frame").src=url;
    }
    setInterval(function (){
        document.getElementById("frame").height=window.innerHeight-100;
    },100)
</script>
</body>
</html>
