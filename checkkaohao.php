<?php
/*
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
function checkkaohao($photo,$arr) {
    $kaohao="";
    $a=array();
    for($i=1;$i<=$arr["numberOfColumns"];$i++)
    {
        $c=$arr[$i];
        for($j=0;$j<10;$j++)
        {
            $zuobiao=$c[$j];
            var_dump($c);
            echo "<br>";
            $a[$i][$j]=checkphoto($photo,$zuobiao["startx"],$zuobiao["starty"],$zuobiao["stopx"],$zuobiao["stopy"]);

        }
    }
    var_dump($a);
    $max=0;
    $max_index=0;
    for($i=1;$i<=$arr["numberOfColumns"];$i++)
    {
        for($j=0;$j<10;$j++)
        {
            if($a[$i][$j]>$max){
                $max=$a[$i][$j];
                $max_index=$j;
            }
            $kaohao+=$max_index;
        }
    }
	return settype($kaohao,"integer");
}//*/
$file=file_get_contents("examConfig.json");
$json=json_decode($file,true);
var_dump($json);
?>