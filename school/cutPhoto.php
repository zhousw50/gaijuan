<?php
include_once "../config.php";
$path=$_GET["photo"];
$startx=$_GET["x1"];
$starty=$_GET["y1"];
$stopx=$_GET["x2"];
$stopy=$_GET["y2"];
$img=imagecreatefromjpeg($path);
$img1=imagecreatetruecolor($stopx-$startx,$stopy-$starty);
imagecopy($img1, $img,0,0,$startx,$starty,$stopx,$stopy);
imagefilter($img1, IMG_FILTER_GRAYSCALE);
header("content-type:image/jpeg");
imagejpeg($img1);
imagedestroy($img);
imagedestroy($img1);
?>