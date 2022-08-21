<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$id=$_POST["id"];
$prepare=$link->prepare("delete from students where id=?;");
$prepare->execute(array($id));
echo "-->操作成功<--";
?>
