<?php
$id=$_POST["id"];
$pwd=$_POST["pwd"];
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
$student=$link->query("select * from students;");
$a=0;
foreach ($student as $students){
    if($students["id"]==$id&&$students["pwd"]==$pwd)
    {
        echo "{\"type\":\"success\",\"title\":\"登录成功\",\"msg\":\"\"}";
        $a=1;
    }
}
if($a==0)echo "{\"type\":\"error\",\"title\":\"登录失败\",\"msg\":\"学号或密码错误\"}";
?>