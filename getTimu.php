<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$exam_id=$_POST["exam_id"];
$timu=$_POST["timu"];
$subject=$_GET["subject"];
$query=$link->prepare("select * from exams where id=?;");
$query->execute(array($exam_id));
$result=$query->fetch();
$json=json_decode($result["config"],true);

?>