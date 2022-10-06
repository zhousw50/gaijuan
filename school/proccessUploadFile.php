<?php
error_reporting(0);
    $file=$_FILES["file"];
    if($file["type"]!="application/zip")echo '{"type":"error","msg":"不是压缩文件，请重试"}';
    else{
        $uniname=md5(uniqid(microtime(true),true));
        move_uploaded_file($file['tmp_name'],"./$uniname.zip");
        $zip = new ZipArchive();
        $zip->open("./$uniname.zip");
        $zip->extractTo("./upload/$uniname");
        $zip->close();
        unlink("./$uniname.zip");
        $dir=scandir("./upload/$uniname");
        $ii=0;
        for($i=0;$i<count($dir);$i++)
        {
            if($dir[$i]!="."&&$dir[$i]!=".."&&preg_match("[\.]",$dir[$i]))
            {
                $name=$i-$ii+1;
                rename("./upload/$uniname/".$dir[$i],"./upload/$uniname/$name.jpeg");
            }
            else{
                $ii++;
            }
        }
        echo '{"type":"success","msg":"试卷文件夹为 /upload/'.$uniname.'"}';//*/
    }
?>