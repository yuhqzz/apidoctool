<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/docapi/apis.html";i:1539947477;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1539859787;s:49:"../application/index/view/layouts/htmlheader.html";i:1539934366;s:48:"../application/index/view/layouts/htmltitle.html";i:1539930137;s:49:"../application/index/view/layouts/htmlfooter.html";i:1539931598;}*/ ?>
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
                    <nav style="width:100%;border-bottom:1px solid #e1e4e8">
    <select class="form-control float-left w160 mr12" onchange="self.location.href='/docapi/apis/'+options[selectedIndex].value">
        <?php foreach($projects as $pro): ?>
            <option <?php echo !empty($pro)?$pro['projectid']==$proid ? 'selected' : '':''; ?> value="<?php echo $pro['projectid']; ?>"><?php echo $pro['project_name']; ?></option>
        <?php endforeach; ?>
    </select>

</nav>
<div style="clear: both"></div>


<div class="account-l fl" style="width: 20%;margin-top: 20px;">
    <a class="list-title"><?php echo $proname; ?></a>
    <ul id="accordion" class="accordion">
        <?php foreach($modules as $module): ?>
        <li <?php echo $module['id']==$moduleid?"class='open'":''; ?>>
            <div class="link"><i class="fa fa-plug"></i><?php echo $module['module_name']; ?><i class="fa fa-chevron-down"></i></div>
            <ul class="submenu"  style="<?php echo $module['id']==$moduleid?'display:block':''; ?>">
                <?php foreach($module['apis'] as $api): ?>
                <li id="shop"><a><?php echo $api['api_name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>


</div>
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