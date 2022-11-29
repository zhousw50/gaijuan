<?php
$exam=$_POST["exam"];
$subject=$_POST["subject"];
$timu=$_POST["timu"];
include_once "../config.php";
$p=$link->prepare("select * from ".$exam."_".$subject.";");
$p->execute();
$data=$p->fetchAll();
echo $data
?>