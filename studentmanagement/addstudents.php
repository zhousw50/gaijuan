<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$class=$_POST["class"];
$id=$_POST["id"];
$name=$_POST["name"];
$pwd=$_POST["pwd"];
$prepare=$link->prepare("insert into students values(?,?,?,?);");
$prepare->execute(array($class,$id,$name,$pwd));
echo "-->操作成功<--";
?>