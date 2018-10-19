<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:93:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/docapi/index.html";i:1539859763;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1539859787;s:49:"../application/index/view/layouts/htmlheader.html";i:1539856724;s:48:"../application/index/view/layouts/htmltitle.html";i:1539910522;s:49:"../application/index/view/layouts/htmlfooter.html";i:1539856552;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>DocApi</title>
    <link rel="stylesheet" type="text/css" href="/static/home/css/main.css" />
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
    </style>

</head>
<body>
<div id="root">
    <article class="Routes">
        <section class="Header">
    <nav class="clearfix">
        <ul class="nav-links">
            <li><a href="/" class="<?php echo $menuselect==0?'selected':''; ?>"><i class="fa fa-home"></i>&nbsp;DocApi</a></li>
            <li><a href="/index" class="<?php echo $menuselect==1?'selected':''; ?>"><i class="fa fa-user-circle-o"></i>&nbsp;个人主页</a></li>
            <li><a href="/repository" class="<?php echo $menuselect==2?'selected':''; ?>"><i class="fa fa-book"></i>&nbsp;项目</a></li>

            <li><a href="/api" class="<?php echo $menuselect==3?'selected':''; ?>"><i class="fa fa-plug"></i>&nbsp;接口</a></li>
            <li><a href="/status" class="<?php echo $menuselect==4?'selected':''; ?>"><i class="fa fa-link"></i>&nbsp;模拟测试</a></li>
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
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8">
    <div class="Logs card">
        <div class="card-block">
            <div class="Log clearfix">
                <div class="Log-body"><span class="Log-user"><img
                        src="https://work.alibaba-inc.com/photo/undefined.220x220.jpg"
                        class="Log-avatar"><a target="_blank" class="Log-user-link"
                                              href="/https://work.alibaba-inc.com/work/u/undefined">ldf</a></span><span
                        class="Log-type">创建了</span><span class="Log-target"><a
                        href="/repository/editor?id=95180">test</a><span class="slash"> / </span><a
                        href="/repository/editor?id=95180&amp;mod=150269">test</a></span></div>
                <div class="Log-footer"><i class="Log-fromnow">3 小时前</i></div>
            </div>
            <div class="Log clearfix">
                <div class="Log-body"><span class="Log-user"><img
                        src="https://work.alibaba-inc.com/photo/undefined.220x220.jpg"
                        class="Log-avatar"><a target="_blank" class="Log-user-link"
                                              href="/https://work.alibaba-inc.com/work/u/undefined">ldf</a></span><span
                        class="Log-type">创建了</span><span class="Log-target"><a
                        href="/repository/editor?id=95180">test</a></span></div>
                <div class="Log-footer"><i class="Log-fromnow">3 小时前</i></div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-sm-4 col-md-4 col-lg-4">
    <div class="card">
        <div class="card-header">我拥有的仓库</div>
        <div class="card-block"><p><a
                href="/repository/editor?id=95180"><span></span><span>test</span></a></p></div>
    </div>
    <div class="card">
        <div class="card-header">我加入的仓库</div>
        <div class="card-block"><span>-</span></div>
    </div>
</div>
                </div>
            </div>
        </div>
        <div class="Footer">Powered By @liuxiaomo</div>
    </article>
</div>
</body>
</html>