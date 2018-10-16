<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:96:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/admin/view/adminauth/login.html";i:1539667891;s:49:"../application/admin/view/layouts/htmlheader.html";i:1539668118;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>接口文档管理后台</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- Bootstrap 3.3.4 -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/bootstrap.css" />
<!-- Font Awesome Icons -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/font-awesome.min.css" />
<!-- Ionicons -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/ionicons.min.css" />
<!-- Theme style -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/AdminLTE.css" /><link rel="stylesheet" type="text/css" href="/static/admin/css/style-responsive.css" /><link rel="stylesheet" type="text/css" href="/static/admin/css/skins/skin-blue.css" />
<!-- iCheck -->
<link rel="stylesheet" type="text/css" href="/static/admin/plugins/iCheck/square/blue.css" />
<link rel="icon" href="/static/admin/img/medicool.ico" type="image/x-icon" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/admin/js/html5shiv.min.js"></script><script type="text/javascript" src="/static/admin/js/respond.min.js"></script>
<![endif]-->
<style>
    .frame {
        width: 200px;
        height: 30px;
        border: none;
        vertical-align: middle;
    }
    .file{
        position: absolute;
        filter: alpha(opacity:0);
        opacity: 0;
        width: 70px;
    }
    .coverfile{
        right: 400px;
        top: 250px;
    }
</style>

</head>
<script type="text/javascript">
    function keyLogin(){
        if (event.keyCode==13)   //回车键的键值为13
            document.getElementById("submit").click(); //调用登录按钮的登录事件
    }
</script>
<body class="hold-transition login-page" onkeydown="keyLogin();">
<div class="login-box">
    <div class="login-logo">
        <b>接口文档管理登录</b>
    </div><!-- /.login-logo -->

    <div class="alert alert-danger" style="display: none" id="errordiv">
        <strong>喔 NO!</strong> 您输入的信息，有以下问题.<br><br>
        <ul>
            <li id="errormsg"></li>
        </ul>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">登录 管理后台</p>
        <form action="admin/dologin" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="用户名" name="username" id="username"/>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="密 码" name="password" id="password"/>
            </div>
            <!--<div class="form-group has-feedback">-->
                <!--<input type="captcha" class="form-control" style="width: 60%;float:left" placeholder="验证码" name="captcha" id="captcha"/>-->
                <!--<img src="<?php echo captcha_src(); ?>" alt="captcha" style="width: 34%;margin-left:5%"/>-->
            <!--</div>-->
            <div class="row">
                <div class="col-xs-8">
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="button" id="submit" class="btn btn-primary btn-block btn-flat"> 登录 </button>
                </div><!-- /.col -->
            </div>
        </form>


    </div><!-- /.login-box-body -->

</div><!-- /.login-box -->


<!-- jQuery 2.1.4 -->
<script src="/static/admin/plugins/jQuery/jquery-1.9.1.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="/static/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="/static/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="/static/admin/js/app.js" type="text/javascript"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        $("#submit").click(function(){
            var username=$("#username").val();
            var password=$("#password").val();
            var captcha=$("#captcha").val();
            if(username==""||password==""||captcha=="")
            {
                $("#errordiv").show();
                $("#errormsg").html("账号、密码或验证码不能为空");
                return;
            }
            $.ajax({
                type: "POST",
                url: "/adminauth/dologin",
                data:{'username':username,'password':password,'captcha':captcha},
                success: function(msg){
                    if(msg==0)
                    {
                        window.location.href="/adminauth/index";
                    }
                    else
                    {
                        $("#errordiv").show();
                        $("#errormsg").html("账号、密码或验证码错误");
                        return;
                    }
                }
            });
        });
    });
</script>
</body>
</html>