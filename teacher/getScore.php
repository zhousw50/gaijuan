<?php
//error_reporting(0);
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$examid=$_GET["examid"];
$exam=array();
foreach ($link->query("select * from exams") as $exams){
    if($exams["id"]==$examid){
        $exam=$exams;
    }
}
$config=json_decode($exam["config"],true);
$chengji=array();
foreach($config["subject"] as $item)
{
    $score=0;
    $prepare=$link->prepare("select * from ".$examid."_"."$item where id=".$_GET["id"]);
    $prepare->execute();
    $a=$prepare->fetch();
    for($i=0;$i<$config[$item]["numberOfTimu"];$i++){
        $timuconfig=$config[$item][$i];
        if($timuconfig["type"]==0){
            if($a["timu_$i"]==$timuconfig["ans"]){
                $score+=$timuconfig["point"];
            }
        }
        if($timuconfig["type"]==2){
            settype($a["timu_$i"],"float");
            $score+=$a["timu_$i"];
        }
    }
    $chengji[$item]=$score;
}
echo json_encode($chengji);
?>