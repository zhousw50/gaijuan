<?php
include_once "../config.php";
$id=$_POST["id"];
$prepare=$link->prepare("delete from students where id=?;");
$prepare->execute(array($id));
echo "操作成功";
?>
