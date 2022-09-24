<?php
$id=$_POST["id"];
$pwd=$_POST["pwd"];
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$teacher=$link->query("select * from teachers;");
$a=0;
foreach ($teacher as $teachers){
    if($teachers["id"]==$id&&$teachers["pwd"]==$pwd)
    {
        echo "{\"type\":\"success\",\"title\":\"登录成功\",\"msg\":\"\"}";
        $a=1;
    }
}
$_COOKIE["loginas"]="teacher";
$_COOKIE["id"]=$id;
if($a==0)echo "{\"type\":\"error\",\"title\":\"登录失败\",\"msg\":\"ID或密码错误\"}";
?>