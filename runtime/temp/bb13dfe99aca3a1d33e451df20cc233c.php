<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:94:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/admin/view/admin/adduser.html";i:1539833068;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/admin/view/layouts/admin.html";i:1539762352;s:49:"../application/admin/view/layouts/htmlheader.html";i:1539745999;s:49:"../application/admin/view/layouts/mainheader.html";i:1539832086;s:45:"../application/admin/view/layouts/menuer.html";i:1539764240;s:49:"../application/admin/view/layouts/htmlfooter.html";i:1539762186;}*/ ?>
<!DOCTYPE html>
<html lang="en">
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
    .apiformlabel{
        float: left;
        line-height: 35px;
        margin-right: 10px;
    }
</style>

<body class="skin-blue sidebar-mini fixed">
<div class="wrapper">
    <!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Shop</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">接口文档管理后台</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="/static/admin/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="/static/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                            <p>

                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人信息</a>
                            </div>
                            <div class="pull-right">
                                <a href="/adminauth/loginOut" class="btn btn-default btn-flat">退出登录</a>
                            </div>
                        </li>
                    </ul>
                </li>



            </ul>
        </div>
    </nav>
</header>

    <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <div class="panel-heading" role="tab" id="heading1">
                <h4 class="panel-title">
                    <a class="single-item">
                        <i class="fa fa-home"></i>&nbsp;&nbsp;管理后台
                    </a>
                </h4>
            </div>
            <!-- Optionally, you can add icons to the links -->

            <li>
                <a href="#">
                    <i class='fa fa-desktop'></i> <span>项目管理</span>
                    <i class="pull-right fa fa-caret-down"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/projects">项目列表
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/docapis">接口列表
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/types">项目环境管理(未开发)
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='fa fa-desktop'></i> <span>用户管理</span>
                    <i class="pull-right fa fa-caret-down"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/users">用户管理
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!--<section class="content-header">-->
            <!--<h1>-->
                <!--首页-->
                <!--<small>欢迎页</small>-->
            <!--</h1>-->
        <!--</section>-->
        <br/> <br/>
        <!-- Main content -->
        <section class="content">
            <div class="container spark-screen">
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $userdata['userid']==0?"添加":"编辑"; ?>用户</div>
<div class="panel-body">
    <form action="/admin/doAddUser" method="POST">
        <div class="box-body">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="hidden" name="userid" value="<?php echo $userdata['userid']; ?>"/>
                <input type="text" name="username" value="<?php echo $userdata['username']; ?>" class="form-control" placeholder="请输入用户名">
            </div>
            <div class="form-group">
                <label for="userpwd">密码</label>
                <input type="text" name="userpwd" value="<?php echo $userdata['truepwd']; ?>" class="form-control" placeholder="请输入密码">
            </div>

            <div class="form-group">
                <select onchange="userlevelchange()" class="form-control" id="userlevel" name="userlevel">
                    <option value="-1" <?php echo !empty($userdata)?'':'selected'; ?>>请选择</option>
                    <option value="1" <?php echo !empty($userdata)?$userdata['userlevel']==1 ? 'selected' : '':''; ?>>普通用户</option>
                    <option value="2" <?php echo !empty($userdata)?$userdata['userlevel']==2 ? 'selected' : '':''; ?>>项目管理员</option>
                </select>
            </div>

            <div class="form-group">
                <label for="proid">可读项目</label><br/>
                <?php foreach($prolists as $project): ?>
                <input type="checkbox" <?php echo $project['prodic']==0?'checked':($project['prodic']==1?'checked':''); ?> value="<?php echo $project['projectid']; ?>" name="proid[]"/><?php echo $project['project_name']; ?>&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>

            </div>

            <div class="form-group" style="<?php echo !empty($userdata)?$userdata['userlevel']==1 ? 'display: none' : '':''; ?>" id="editprodiv">
                <label for="proid">可编辑项目</label><br/>
                <?php foreach($prolists as $project): ?>
                <input type="checkbox" <?php echo !empty($userdata)?$userdata['userlevel']==1 ? 'disabled' : '':''; ?>  <?php echo $project['prodic']==1?'checked':''; ?> value="<?php echo $project['projectid']; ?>" name="editproid[]"/><?php echo $project['project_name']; ?>&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">确认保存</button>
            </div>
        </div>
    </form>
</div>

<script>
    //权限限制
    function userlevelchange(){
        var userlevel = $("#userlevel").find('option:selected').val();
        if(userlevel==2){
            $("#editprodiv").show();
            $('#editprodiv input').attr("disabled",false);
        }else{
            $("#editprodiv").hide();
            $('#editprodiv input').attr("disabled",true);
        }
    }

</script>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <a href="#"></a><b>接口文档管理后台</b></a>. 刘单风专用后台
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <a href="#">刘单风</a>.</strong>  刘单风所有
</footer>


<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="/static/admin/plugins/jQuery/jquery-1.9.1.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="/static/admin/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script type="text/javascript" src="/static/admin/plugins/iCheck/icheck.min.js"></script><script type="text/javascript" src="/static/admin/js/app.js"></script>
<script type="text/javascript" src="/static/admin/js/DatePicker/WdatePicker.js"></script>

</body>
</html>