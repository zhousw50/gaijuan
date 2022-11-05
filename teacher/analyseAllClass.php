<?php
function get($var){
    $val="";
    $url=$_SERVER['REQUEST_URI'];
    $arr=explode("/",$url);
    $arr1=array();
    $number=1;
    foreach($arr as $a){
        $number++;
    }
    for($i=2;$i<=$number-2;$i++)
    {
        $arr1[$i-2]=$arr[$i];
    }
    for($i=0;$i<$number-3;$i++){
        if($arr1[$i]==$var)$val=$arr1[$i+1];
    }
    return $val;
}
include_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src=<?php echo $jquery_js; ?>></script>
    <link rel="stylesheet" href=<?php echo $mdui_css; ?>>
    <script src=<?php echo $mdui_js; ?>></script>
    <script src=<?php echo $swal2_js; ?>></script>
    <script src=<?php echo $header_js; ?>></script>
</head>

<body><?php
$prepare=$link->prepare("select * from exams where id=?");
$prepare->execute(array(get("exam")));
$exam=$prepare->fetch();
?><?php
$subject=urldecode(get("subject"));?>
<div class="mdui-container">
    <div class="mdui-card">
        <div class="mdui-card-container">

            <table class="mdui-table-fluid mdui-table mdui-table-hoverable">
                <thead>
                <tr>
                    <th>考号</th>
                    <th>学生</th>
                    <th>成绩</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($link->query("select id,name from students where class=".get("class").";") as $student){
                    echo "<tr><td>".$student["id"]."</td><td>".$student["name"]."</td><td id='score-".$student["id"]."'></td></tr>";
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    <?php
    foreach($link->query("select id,name from students where class=".get("class").";") as $student){
        echo "$.ajax({
        type:\"GET\",
        url:\"/teacher/getScore.php?examid=".get("exam")."&id=".$student["id"]."\",
        success:function (msg) {
            var a=JSON.parse(msg);
            document.getElementById(\"score-".$student["id"]."\").innerText=a[\"$subject\"];
        }
    });";
    }
    ?>

</script>
</body>
</html>