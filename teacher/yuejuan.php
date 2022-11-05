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
$link=new PDO("mysql:host=localhost;dbname=zhousw","zhousw","qwerty");
    $exam_id=get("exam");
    $timu=get("timu");
?>
<?php
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
    <link rel="stylesheet" href=<?php echo $waves_css; ?>>
</head>
<body>
<script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
<div class="mdui-container mdui-p-t-3 mdui-col-xs-8 mdui-col-offset-xs-3">
    <div class="mdui-col">
        <div class="mdui-card">
            <img id="photo" class="mdui-img-fluid">
        </div>
    </div>
</div>
<div class="mdui-container mdui-p-t-3">
    <div class="mdui-row">
        <div class="mdui-col">
            <div style="position:fixed; top:140px; left:20px;" class="mdui-card mdui-card-content mdui-col-xs-2">
                <div class="mdui-card-primary">
                    <div class="mdui-card-primary-title">给分版</div>
                    <div class="mdui-card-primary-subtitle">请输入分数</div>
                </div>
                <div class="mdui-card-content">
                    <div class="mdui-textfield mdui-textfield-floating-label">
                        <label class="mdui-textfield-label">分数</label>
                        <input class="mdui-textfield-input" id="point"/>
                        <span style="color: red;" id="error"></span><br>
                        <button id="submit" class="mdui-btn mdui-btn-raised mdui-ripple" disabled>确定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.body.scrollTop = document.documentElement.scrollTop = 0;
    var msg,id;
    document.getElementById("point").oninput = function () {
        if (this.value > msg["max_point"]) {
            hasError = true;
        } else {
            hasError = false;
        }
        if(!this.value)document.getElementById("submit").setAttribute("disabled","true");
        if (hasError) {
            document.getElementById("error").removeAttribute("hidden");
            document.getElementById("error").innerHTML = "数字太大啦,请重新输入";
            document.getElementById("submit").setAttribute("disabled","true");
        } else {
            document.getElementById("error").setAttribute("hidden", "true");
            document.getElementById("submit").removeAttribute("disabled");
            if(!this.value)document.getElementById("submit").setAttribute("disabled","true");
        }
    }
    $.ajax({
        type:"POST",
        url:"/teacher/getTimu.php",
        data:"<?php
            if(!get("exam")&&!get("timu")){
                header('Refresh: 0; url=./');
            }
            else{
                $exam_id=get("exam");
                $timu=get("timu");
                $subject=get("subject");
                echo "exam_id=$exam_id&timu=$timu&subject=$subject";
            }
            ?>",
        success:function (msg1){
            msg=JSON.parse(msg1);
            if(msg["number"]==0){
                Swal.fire({
                    icon:"info",
                    title:"这道题已经改完"
                })
            }
            var a=Math.floor(Math.random()*msg["number"]);
            id=msg["id"][a]
            document.getElementById("photo").src=msg[id]["photo"];
        },
        error:function (){
            document.getElementsByTagName("body")[0].innerHTML="<h1>网络问题或不支持ajax</h1>"
            document.getElementsByTagName("body")[0].removeAttribute("class");
        }
    });
    document.getElementById("submit").onclick=function (){
        $.ajax({
            type:"POST",
            url:"/teacher/proccessTimu.php",
            data:"<?php
                $exam_id=get("exam");
                $timu=get("timu");
                $subject=get("subject");
                echo "exam_id=$exam_id&timu=$timu&subject=$subject";
                ?>&id="+id+"&point="+document.getElementById("point").value,
            success:function (msg){
                Swal.fire({
                    icon:"success",
                    title:msg,
                    timer:800,
                    showConfirmButton:false,
                    toast: true,
                    position: 'top-end'
                }).then(()=>{
                    window.location.reload();
                });
            },
            error:function (){
                document.getElementsByTagName("body")[0].innerHTML="<h1>网络问题或不支持ajax</h1>"
                document.getElementsByTagName("body")[0].removeAttribute("class");
            }
        })
        
    }
</script>
</body>
</html>
