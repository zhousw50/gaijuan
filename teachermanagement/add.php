<?php
include_once "../config.php";
$subject=$_POST["subject"];
$id=$_POST["id"];
$name=$_POST["name"];
$pwd=$_POST["pwd"];
$prepare=$link->prepare("insert into teachers values(?,?,?,?);");
$prepare->execute(array($subject,$id,$name,$pwd));
echo  "操作成功";
?>