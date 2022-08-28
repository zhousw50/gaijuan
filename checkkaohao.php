<?php
error_reporting(0);
function checkphoto($path, $startx, $starty, $stopx, $stopy) {
    $sums = 0;
    $img = imagecreatefromjpeg($path);
    $img1 = imagecreatetruecolor($stopx - $startx, $stopy - $starty);
    imagecopy($img1, $img, 0, 0, $startx, $starty, $stopx, $stopy);
    imagefilter($img1, IMG_FILTER_GRAYSCALE);
    for ($i = 0; $i < $stopx - $startx; $i++) {
        for ($j = 0; $j < $stopy - $starty; $j++) {
            $rgb = imagecolorat($img1, $i, $j);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $gray = ($r + $g + $b) / 3;
            if ($gray > 160) {
                imagesetpixel($img1, $i, $j, 0xFFFFFF);
                $sums+= 0;
            } else {
                imagesetpixel($img1, $i, $j, 0x000000);
                $sums+= 1;
            }
        }
    }
    imagedestroy($img);
    imagedestroy($img1);
    return floor($sums / (($stopx - $startx) * ($stopy - $starty)) * 100);
}
function checkkaohao($photo,$arr1) {
    $arr=$arr1[0]["kaohao"][0];
    $kaohao="";
    $a=array();
    $number=$arr["numberOfColumns"];
    for($i=1;$i<=$number;$i++)
    {
        $c=$arr[$i][0];
        for($j=0;$j<10;$j++)
        {
            $zuobiao=$c[$j][0];
            $a[$i][$j]=checkphoto($photo,$zuobiao["startx"],$zuobiao["starty"],$zuobiao["stopx"],$zuobiao["stopy"]);
        }
    }
    for($i=1;$i<=$number;$i++)
    {
        $max=0;
        $max_index=0;
        for($j=0;$j<10;$j++)
        {
            if($a[$i][$j]>$max){
                $max=$a[$i][$j];
                $max_index=$j;
            }
            settype($max_index,"string");
        }
        $kaohao=$kaohao.$max_index;
    }
    settype($kaohao,"integer");
	return $kaohao;
}
header("content-type:application/json;charset:utf-8");
$file=file_get_contents("examConfig.json");
$json=json_decode($file,true);
$result=checkkaohao("./2.jpeg",$json["数学"]);
echo $result;
?>