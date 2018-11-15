<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/index/index.html";i:1541989792;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1541989792;s:49:"../application/index/view/layouts/htmlheader.html";i:1541989792;s:48:"../application/index/view/layouts/htmltitle.html";i:1541989792;s:49:"../application/index/view/layouts/htmlfooter.html";i:1541989792;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>DocApi</title>
    <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="/static/admin/plugins/jQuery/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/home/css/main.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/leftnav.css" />

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
    <style type="text/css">/* Chart.js */
    @-webkit-keyframes chartjs-render-animation {
        from {
            opacity: 0.99
        }
        to {
            opacity: 1
        }
    }

    @keyframes chartjs-render-animation {
        from {
            opacity: 0.99
        }
        to {
            opacity: 1
        }
    }

    .chartjs-render-monitor {
        -webkit-animation: chartjs-render-animation 0.001s;
        animation: chartjs-render-animation 0.001s;
    }


        .apihd{
            margin-top:20px;border-left: 5px solid #3c8dbc;
            text-indent:5px;font-weight: bold;margin-bottom: 15px;
        }
    .apivalue{
        margin-left:10px;
    }
    </style>

</head>
<body>
<div id="root">
    <article class="Routes">
        <section class="Header">
    <nav class="clearfix">
        <ul class="nav-links">
            <li><a href="/" class="<?php echo $menuselect==0?'selected':''; ?>"><i class="fa fa-home"></i>&nbsp;DocApi</a></li>
            <li><a href="/docapi" class="<?php echo $menuselect==1?'selected':''; ?>"><i class="fa fa-user-circle-o"></i>&nbsp;个人主页</a></li>
            <li><a href="/docapi/projects" class="<?php echo $menuselect==2?'selected':''; ?>"><i class="fa fa-book"></i>&nbsp;项目</a></li>

            <li><a href="/docapi/apis" class="<?php echo $menuselect==3?'selected':''; ?>"><i class="fa fa-plug"></i>&nbsp;接口</a></li>
            <li><a href="/docapi/apitest" class="<?php echo $menuselect==4?'selected':''; ?>"><i class="fa fa-link"></i>&nbsp;接口测试</a></li>
        </ul>
        <ul class="nav-actions list-inline float-right">
            <?php if(\think\Session::get('adminuser')): ?>
            <li><a class="name"><?php echo \think\Session::get('adminuser.username'); ?></a></li>
            <li><a href="/adminauth/loginOut">退出</a></li>
            <?php else: ?>
            <li><a href="/loginauth">登录</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</section>
        <div class="body">
            <div class="Home">
                <div class="row">
                    <div class="container">
    <!-- Jumbotron -->
    <div class="jumbotron" style="text-align: center">
        <h1>DocApi</h1>

        <p class="lead">DocApi是一个为您提供API管理、API测试、API文档的服务平台。</p>
        <p> 你还在用Word管理接口文档吗？你还在使用拼接URL测试吗？</p>
        <p style="font-weight: bold"> 你OUT了！用了这个网站,告别加班不是梦! ! !</p>

        <p>
            <a class="btn btn-lg btn-success" href="https://github.com/zhuifengxia/apidoctool" target="_blank" role="button">
                GitHub
            </a>
        </p>
    </div>

    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4" style="margin-right:30%">
            <h2>轻松编辑</h2>
            <p>可视化编辑，完善的版本控制，各种格式的导入导出。让前后端约定接口的工作变得十分简单 </p>
        </div>

        <div class="col-md-4">
            <h2>轻松测试</h2>
            <p>DocApi可以根据实际需求进行测试，
                校验真实接口的准确性</p>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
        <div class="Footer">Powered By @<a href="/adminauth/index">liuxiaomo</a></div>
<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="/static/admin/plugins/jQuery/jquery-1.9.1.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="/static/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/home/js/leftnav.js"></script>

<script type="text/javascript" src="/static/home/js/jsonFormater.js"></script>

    </article>
</div>
</body>
</html>