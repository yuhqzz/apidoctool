<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:96:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/docapi/projects.html";i:1539945387;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1539859787;s:49:"../application/index/view/layouts/htmlheader.html";i:1539934366;s:48:"../application/index/view/layouts/htmltitle.html";i:1539930137;s:49:"../application/index/view/layouts/htmlfooter.html";i:1539931598;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>DocApi</title>
    <link rel="stylesheet" type="text/css" href="/static/home/css/main.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/leftnav.css" />

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
            <li><a href="/docapi" class="<?php echo $menuselect==1?'selected':''; ?>"><i class="fa fa-user-circle-o"></i>&nbsp;个人主页</a></li>
            <li><a href="/docapi/projects" class="<?php echo $menuselect==2?'selected':''; ?>"><i class="fa fa-book"></i>&nbsp;项目</a></li>

            <li><a href="/docapi/apis" class="<?php echo $menuselect==3?'selected':''; ?>"><i class="fa fa-plug"></i>&nbsp;接口</a></li>
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
                    <?php foreach($projects as $project): ?>
<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
    <div class="Repository card">
        <div class="card-block">
            <div class="name">
                <i class="fa fa-book" style="color:#3c8dbc"></i>&nbsp;&nbsp;<a href="/docapi/apis/<?php echo $project['projectid']; ?>"><?php echo $project['project_name']; ?></a>
            </div>
            <div class="desc"><?php echo $project['project_info']; ?></div>
        </div>
        <div class="card-block card-footer">
            <span class="ownername"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $project['last_user']; ?></span><span
                class="fromnow"><?php echo $project['last_time']; ?>更新</span></div>
    </div>
</div>
<?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="Footer">Powered By @<font color="#3c8dbc">liuxiaomo</font></div>
<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="/static/admin/plugins/jQuery/jquery-1.9.1.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="/static/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/home/js/leftnav.js"></script>
    </article>
</div>
</body>
</html>