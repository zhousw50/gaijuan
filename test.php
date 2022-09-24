<?php
$url=$_SERVER['REQUEST_URI'];
$arr=explode("/",$url);
$arr1=array();
$number=1;
foreach($arr as $a){
    $number++;
}
for($i=2;$i<=$number-2;$i++)
{
    $arr1[$i-2]=$arr[$i];
}
var_dump($arr1);
for($i=0;$i<$number-3;$i++){
    if($arr1[$i]=="exam")echo "<br>".$arr1[$i+1];
}
?>