<?php
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
function checkkaohao($photo) {
	$kaohao=0;
	for ($j=0;$j<5;$j++) {
		for ($i=0;$i<10;$i++) {
			$x1=966+$j*48;
			$x2=989+$j*48;
			$y1=531+31*$i;
			$y2=546+31*$i;
			$aaa[$i]=checkphoto($photo,$x1,$y1,$x2,$y2);
		}
		$max=0;
		$xb=0;
		for ($i=0;$i<10;$i++) {
			if($aaa[$i]>$max) {
				$max=$aaa[$i];
				$xb=$i;
			}
		}
		$kaohao+=$xb*pow(10,4-$j);
	}
	return $kaohao;
}
echo checkkaohao("a.jpeg")
?>