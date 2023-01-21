<?php
$exam=$_POST["exam"];
$subject=$_POST["subject"];
$timu=$_POST["timu"];
$message=$_POST["message"];
$arr=explode("\n",$message);
include_once "../config.php";
$p=$link->prepare("select * from ".$exam."_".$subject.";");
$p->execute();
$data=$p->fetchAll();
foreach($arr as $a) {
    $link->query("update $exam"."_"."$subject set timu_$timu=\"\"where id=$a;");
}
$link->query("update exams set finish=0 where id=$exam;");
?>