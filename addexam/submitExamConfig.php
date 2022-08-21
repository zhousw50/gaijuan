<?php
$file=$_FILES["file"];
if($file["type"]!="text/plain")echo "不是文本文档，请重试";
else{
    $uniname=md5(uniqid(microtime(true),true));
    move_uploaded_file($file['tmp_name'],$uniname.".txt");
    $json=readfile("./$uniname.txt");
    unlink("./$uniname.txt");
    $config=json_decode($json);
?>