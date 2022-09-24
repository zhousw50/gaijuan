<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$exam_id=$_POST["exam_id"];
$timu=$_POST["timu"];
$subject=$_POST["subject"];
$point=$_POST["point"];
$id=$_POST["id"];///*
$prepare=$link->prepare("update $exam_id"."_"."$subject set timu_"."$timu=? where id=?;");
$prepare->execute(array($point,$id));
//*/
echo "+".$point;
?>