<?php
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$a=$_POST["message"];
$arr=explode("\n",$a);
foreach ($arr as $i=>$str)
{
    $info=explode(" ",$str);
    $prepare=$link->prepare("insert into students values(?,?,?,?);");
    $prepare->execute(array($info[0],$info[1],$info[2],$info[3]));
}
echo "-->操作成功<--";
?>
