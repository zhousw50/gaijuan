<?php
include_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>学生端-改卷系统(开发中)</title>
<script src="<?php echo $swal2_js; ?>"></script>
<script src="<?php echo $jquery_js; ?>"></script>
<link rel="stylesheet" href="<?php echo $mdui_css; ?>" >
<script src="<?php echo $mdui_js; ?>" ></script>
<script src="../<?php echo $header_js; ?>"></script>
</head>

<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab">
<header></header>
<script>
header({
color:"indigo",
header_title:"改卷系统-学生端",
header_link:"./"
});
</script>
<div class="mdui-container mdui-card">
<h1 class="mdui-card-primary-title">你好,<?php
error_reporting(0);
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
foreach ($link->query("select * from students") as $students){
if($students["id"]==$_COOKIE["id"])echo $students["name"];
}?>同学,这里是您的历次考试汇集</h1>
</div>
<?php
foreach ($link->query("select * from exams") as $exams){
echo "<div class=\"mdui-container mdui-card\">
<a onclick='window.location.href=\"./analyseForStudent.php/exam/".$exams["id"]."\";'>
<div class=\"mdui-card mdui-ripple\">
<div class=\"mdui-card-primary-title\">".$exams["name"]."</div>
</div> 
</a>
</div>";
}
?>
</body>
</html>