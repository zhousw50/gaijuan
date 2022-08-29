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
function checktimu($photo,$arr1,$number){
    $arr=$arr1[0][$number][0];
    $a=array();
    if($arr["type"]==0){//如果是选择题,选最大密度
        for($i=1;$i<=$arr["choose"];$i++){
            $zuobiao=$arr[$i][0];
            $a[$i]=checkphoto($photo,$zuobiao["startx"],$zuobiao["starty"],$zuobiao["stopx"],$zuobiao["stopy"]);
        }
        $max=0;
        $max_index=0;
        for($j=1;$j<=$arr["choose"];$j++)
        {
            if($a[$j]>$max){
                $max=$a[$j];
                $max_index=$j;
            }
        }
        settype($max_index,"string");
        return $max_index;
    }/*多项选择题部分没思路,暂不开发
    if($arr["type"]==1){
        for($i=1;$i<=$arr["choose"];$i++){
            $zuobiao=$arr[$i][0];
            $a[$i]=checkphoto($photo,$zuobiao["startx"],$zuobiao["starty"],$zuobiao["stopx"],$zuobiao["stopy"]);
        }
        $max=0;
        $max_index=array();
        var_dump($a);
        for($j=1;$j<=$arr["choose"];$j++)
        {

        }
        return $max_index;
    }*/
}
//error_reporting(0);
$file=$_FILES["file"];
if($file["type"]!="text/plain"){echo "不是文本文档，请重试";die();}
else {
    move_uploaded_file($file['tmp_name'], "./examConfig.json");
}
$file=file_get_contents("./examConfig.json");
unlink("./examConfig.json");
//echo $file;
///*
$json=json_decode($file,true);
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
for($i=1;$i<=$json["numberOfSubjects"];$i++){
    $a="";
    $subject=$json["subject"][$i-1];
    $arr=$json[$subject][0];
    for($j=0;$j<$arr["numberOfTimu"];$j++){
        if($j!=$arr["numberOfTimu"]-1){
            if($arr[$j][0]["type"]==0) $a=$a."timu_$j int,";
            if($arr[$j][0]["type"]==2) $a=$a."timu_$j numeric(10,10),";
        }
        else {
            if($arr[$j][0]["type"]==0) $a=$a."timu_$j int";
            if($arr[$j][0]["type"]==2) $a=$a."timu_$j numeric(10,10)";
        }
    }
    $name=$json["exam_id"]."_".$json["subject"][$i-1];
    $query="create table $name(id int,url text,$a);";
    $link->query($query);
    //echo $query."\n";
    for($z=1;$z<=$arr["numberOfDtk"];$z++) {
        $photo=$arr["dtk_URL"]."$z.jpeg";
        $a = "";
        for ($j = 0; $j < $arr["numberOfTimu"]; $j++) {
            if ($j != $arr["numberOfTimu"] - 1) {
                if ($arr[$j][0]["type"] == 0) $a = $a . " timu_$j ,";
            } else {
                if ($arr[$j][0]["type"] == 0) $a = $a . " timu_$j ";
            }
        }
        $b = "";
        for ($j = 0; $j < $arr["numberOfTimu"]; $j++) {
            if ($j != $arr["numberOfTimu"] - 1) {
                if ($arr[$j][0]["type"] == 0) $b = $b . " " . checktimu($photo, $json["数学"], $j) . " ,";
            } else {
                if ($arr[$j][0]["type"] == 0) $b = $b . " " . checktimu($photo, $json["数学"], $j) . " ";
            }
        }
        $kaohao = checkkaohao($photo, $json["数学"]);
        $query = "insert into $name(id,url,$a) values ($kaohao,\"$photo\",$b);";
        //echo $query."\n";
        $link->query($query);
    }
}
echo "处理成功!";//*/
?>