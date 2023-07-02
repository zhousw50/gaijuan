<?php
include_once "../config.php";
$id=$_POST["id"];
$prepare=$link->prepare("delete from teachers where id=?;");
$prepare->execute(array($id));
echo "操作成功";
?>
