<?php
include_once "../config.php";
$p=$link->prepare("update exams set config=? where id=?");
$p->execute(array($_POST["config"],$_POST["exam"]));
echo "操作成功";
?>