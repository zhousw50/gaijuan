var name1,p1,p2
function createCookie(name,value,days,path,domain,secure){
    if(days){
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = date.toGMTString();
    }
    else var expires = "";
    cookieString = name + "=" +excape(value);
    if(expires) cookieString += ";expires=" +expires;
    if(path) cookieString += ";path=" + escape(path);
    if(domain) cookieString += ";domain=" + escape(domain);
    if(secure) cookieString += ";secure=" + escape(secure);
    document.cookie = sookieString;
}
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}
function sub() {
    name1=document.getElementById("name").value;
    p1=document.getElementById("p1").value;
    p2=document.getElementById("p2").value;
    Swal.clickConfirm()
    if(name1==schoolname||p1==password1||p2==password2){
        Swal.fire({icon:"success",title:"登录成功",timer:1000,showConfirmButton: false}).then(() => {
            createCookie("loginas","school",9e50);
            window.location.reload()
        });
    }
    else {
        Swal.fire({icon:"error",title:"登录失败",timer:1000,showConfirmButton: false}).then(() => {
            window.location.reload()
        });
    }
}
function school(){
    Swal.fire({
        showConfirmButton: false,
        allowEscapeKey:false,
        allowOutsideClick:false,
        icon: 'info',
        title: '以学校管理员登陆',
        html:"名称<input id='name'><br>密码1<input id='p1'><br>密码2<input id='p2'><br><button onclick='sub()' class=\"swal2-confirm swal2-styled\" aria-label style=\"display: inline-block;\">确定</button>"
    })
}
function student(){
    Swal.fire({
        showConfirmButton: false,
        allowEscapeKey:false,
        allowOutsideClick:false,
        icon: 'info',
        title: '以学生登陆',
        html:"<form action=\"student.php\" method=\"post\">名称<input name='name'><br>密码<input name='p'><br><button name=\"submit\" class=\"swal2-confirm swal2-styled\" aria-label style=\"display: inline-block;\">确定</button>"
    })
}