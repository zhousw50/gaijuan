<?php
header("content-type:image/jpeg");
$path=$_GET["photo"];
$img=imagecreatefromjpeg($path);
imagejpeg($img);
imagedestroy($img);
?>