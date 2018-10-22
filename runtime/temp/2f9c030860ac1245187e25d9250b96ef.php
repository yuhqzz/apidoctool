<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:93:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/docapi/index.html";i:1540176119;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1539859787;s:49:"../application/index/view/layouts/htmlheader.html";i:1540172287;s:48:"../application/index/view/layouts/htmltitle.html";i:1539930137;s:49:"../application/index/view/layouts/htmlfooter.html";i:1539931598;}*/ ?>
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

            <?php foreach($indexupdate as $onedata): ?>
            <div class="Log clearfix">
                <div class="Log-body">
                    <span class="Log-user">
                        <img
                        src="https://work.alibaba-inc.com/photo/undefined.220x220.jpg"
                        class="Log-avatar">
                        <a target="_blank" class="Log-user-link"><?php echo $onedata['showtype']==0?$onedata['create_user']:$onedata['update_user']; ?></a></span><span
                        class="Log-type"><?php echo $onedata['showtype']==0?创建了:更新了; ?></span>
                    <span class="Log-target">
                        <a href="/docapi/apis/<?php echo $onedata['projectid']; ?>">【<?php echo $onedata['project_name']; ?>】</a>
                        <a href="/docapi/apis/<?php echo $onedata['projectid']; ?>/<?php echo $onedata['moduleid']; ?>"><?php echo $onedata['module_name']; ?></a>
                        <span>/</span>
                        <a
                        href="/docapi/apis/<?php echo $onedata['projectid']; ?>/<?php echo $onedata['moduleid']; ?>/<?php echo $onedata['apiid']; ?>"><?php echo $onedata['api_name']; ?></a></span></div>
                <div class="Log-footer"><i class="Log-fromnow"><?php echo $onedata['showtype']==0?$onedata['create_time']:$onedata['update_time']; ?></i>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="col-12 col-sm-4 col-md-4 col-lg-4">
    <div class="card">
        <div class="card-header">我创建的项目</div>
        <div class="card-block">
            <?php foreach($createdata as $mycreate): ?>
            <p>
                <a href="/docapi/apis/<?php echo $mycreate['projectid']; ?>"><i class="fa fa-book"></i>&nbsp;&nbsp;<span><?php echo $mycreate['project_name']; ?></span></a>
                <span style="float: right;color:#dedede"><?php echo date("y-m-d h:i:s",$mycreate['create_time']); ?></span>
            </p>
            <?php endforeach; ?>
            <?php echo !empty($createdata)?"":"暂无数据"; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header">我加入的项目</div>
        <div class="card-block">
            <?php foreach($joindta as $myjoin): ?>
            <p>
                <a href="/docapi/apis/<?php echo $myjoin['projectid']; ?>"><i class="fa fa-book"></i>&nbsp;&nbsp;<span><?php echo $myjoin['project_name']; ?></span></a>
                <span style="float: right;color:#dedede"><?php echo date("y-m-d h:i:s",$myjoin['create_time']); ?></span>
            </p>
            <?php endforeach; ?>
        </div>
    </div>
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