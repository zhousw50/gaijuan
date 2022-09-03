<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$exam_id=$_POST["exam_id"];
$timu=$_POST["timu"];
$subject=$_POST["subject"];
$query=$link->prepare("select * from exams where id=?;");
$query->execute(array($exam_id));
$result=$query->fetch();
$json=json_decode($result["config"],true);
$config=$json[$subject][0][$timu][0];
$x1=$config["startx"];
$y1=$config["starty"];
$x2=$config["stopx"];
$y2=$config["stopy"];
$rr=array();
$i=0;
foreach ($link->query("select * from ".$exam_id."_"."$subject;") as $item)
{
    $url=$item["url"];
    $id=$item["id"];
    $photo="http://g.zhousw.top/cutPhoto.php?photo=$url&x1=$x1&y1=$y1&x2=$x2&y2=$y2";
    if($item["timu_$timu"]==NULL&&$id!=NULL) {
        $rr["id"][$i]=$id;
        $rr[$id]["id"]=$id;
        $rr[$id]["photo"]=$photo;
        $i++;
    }
}
$rr["max_point"]=$config["point"];
$rr["number"]=$i;
echo json_encode($rr)
?>