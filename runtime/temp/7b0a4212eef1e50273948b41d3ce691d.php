<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:91:"/Users/liudanfeng/Documents/www/blog/public/../application/admin/view/admin/addarticle.html";i:1503300356;s:78:"/Users/liudanfeng/Documents/www/blog/application/admin/view/layouts/admin.html";i:1503300356;s:49:"../application/admin/view/layouts/htmlheader.html";i:1503300356;s:49:"../application/admin/view/layouts/mainheader.html";i:1503300356;s:45:"../application/admin/view/layouts/menuer.html";i:1503300356;s:49:"../application/admin/view/layouts/htmlfooter.html";i:1503300356;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>博客管理后台</title>
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

<body class="skin-blue sidebar-mini fixed">
<div class="wrapper">
    <!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Shop</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">博客管理后台</span>
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
                                <a href="/Adminlogin/loginout" class="btn btn-default btn-flat">退出登录</a>
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
                    <i class='fa fa-desktop'></i> <span>分类管理</span>
                    <i class="pull-right fa fa-caret-down"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/types">文章分类列表
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='fa fa-desktop'></i> <span>文章管理</span>
                    <i class="pull-right fa fa-caret-down"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/articles">文章列表
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/gossips">闲言碎语
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/artrecycle">回收站
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='fa fa-desktop'></i> <span>系统设置</span>
                    <i class="pull-right fa fa-caret-down"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/system">博客配置
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
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo !empty($article['ArticleID'])?"编辑":"添加"; ?>文章</div>
<div class="panel-body">
    <form action="/admin/doAddarticle" method="POST" onsubmit="return datacheck()" name="articleform" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="typename">文章标题</label>
                <span id="ownlabel" style="display: none;margin-left:5px;color:#008000;font-weight: bold">尊重原创，请保证您的文章为原创作品</span>
                <br/>
                <select onchange="typechange(this.value)" class="form-control" id="articletype" name="articletype" style="width:12%;float:left">
                    <option value="-1" <?php echo !empty($article)?'':'selected'; ?>>请选择</option>
                    <option value="0" <?php echo !empty($article)?$article['ArticleType']==0 ? 'selected' : '':''; ?>>原创</option>
                    <option value="1" <?php echo !empty($article)?$article['ArticleType']==1 ? 'selected' : '':''; ?>>转载</option>
                    <option value="2" <?php echo !empty($article)?$article['ArticleType']==2 ? 'selected' : '':''; ?>>翻译</option>
                </select>
                <input type="hidden" id="articleid" name="articleid" value="<?php echo !empty($article)?$article['ArticleID']:''; ?>"/>
                <input  style="float:right;width:87%" type="text" id="articletitle" name="articletitle" value="<?php echo !empty($article['ArticleTitle'])?$article['ArticleTitle']:''; ?>" class="form-control" placeholder="请输入文章标题">
            </div>
            <div class="form-group" style="clear:both;padding-top:20px;">
                <label for="typeid">文章分类</label>
                <select class="form-control" id="typeid" name="typeid">
                    <option value="0">请选择分类</option>
                    <?php foreach($articletype as $type): ?>
                    <option value="<?php echo $type['TypeID']; ?>" <?php echo !empty($article)?($article['TypeID']==$type['TypeID'] ? 'selected' : ''):''; ?> ><?php echo $type['TypeName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="clear:both;padding-top:20px;">
                <label>文章封面图</label>
                <input type="text" name="coverimg" id="coverimg" style="width:400px;" value="<?php echo $article['ArticleImg']; ?>" />
                <input type="button" class="btn" value="浏览...">
                <input type="file" name="coverfile" class="file coverfile" size="28" onchange="document.getElementById('coverimg').value=this.value">
                <input type="button" name="coverimgupload" id="coverimgupload" class="btn" value="上传">
                <iframe id="coverframe" name="coverframe"  class="frame"></iframe>
            </div>

            <div class="form-group" style="padding-top:10px;">
                <label for="articlemsg">文章内容</label>
                <div>
                    <script id="articlemsg" name="articlemsg" type="text/plain" style="height:300px;"><?php echo !empty($article)?$article['ArticleMsg']:''; ?></script>
                </div>
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="articetag">文章标签（最多添加5个标签，多个标签之间用“,”分隔）</label>
                <input type="text" id="articetag" name="articetag" value="<?php echo !empty($article['ArticleTag'])?$article['ArticleTag']:''; ?>" class="form-control" placeholder="请输入文章标签">
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="articedigest">文章摘要（默认自动提取您文章的前200字显示在博客首页作为文章摘要，您也可以在这里自行编辑 ）</label>
                <textarea id="articedigest" name="articedigest" class="form-control" placeholder="请输入文章摘要"><?php echo !empty($article['ArticleDigest'])?$article['ArticleDigest']:''; ?></textarea>
            </div>

            <div class="form-group" style="text-align: center">
                <button type="submit" id="publicbtn" style="margin-right:10%;" class="btn btn-primary">发表文章</button>
                <button type="button" style="margin-right:10%;" onclick="articlesave()" class="btn btn-primary">立即保存</button>
                <a class="btn btn-primary" href="/admin/articles">舍弃</a>
                <span id="savelabel" style="display: none;padding:5px;margin-left:10%;border:1px solid #FFCC00;background-color: #FFFFCC;color:#008000"></span>
            </div>
        </div>
    </form>
</div>
<script>
    function typechange(obj) {
        if(obj==0) {
            $("#ownlabel").show();
        }else {
            $("#ownlabel").hide();
        }
    }
    function datacheck() {
        var articletype=$("#articletype").val();
        var articletitle=$("#articletitle").val();
        var typeid=$("#typeid").val();
        var articlemsg=UE.getEditor('articlemsg').getContent();
        if(articlemsg=="") {
            alert("请输入文章内容");
            return false;
        }
        if(articletype==-1) {
            alert("请选择文章类型");
            return false;
        }
        if(articletitle=="") {
            alert("请输入文章标题");
            return false;
        }

        if(typeid==0) {
            alert("请选择文章分类");
            return false;
        }
    }

    function articlesave() {
        var articleid=$("#articleid").val();
        var articletitle=$("#articletitle").val();
        var typeid=$("#typeid").val();
        var articletype=$("#articletype").val();
        var articlemsg=UE.getEditor('articlemsg').getContent();
        var articedigest=$("#articedigest").val();
        var articetag=$("#articetag").val();
        if(articlemsg=="") {
            alert("请输入文章内容");
            return false;
        }
        if(articletype==-1) {
            alert("请选择文章类型");
            return false;
        }
        if(articletitle=="") {
            alert("请输入文章标题");
            return false;
        }

        if(typeid==0) {
            alert("请选择文章分类");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/admin/ajaxarticle",
            data:"articleid="+articleid+"&articletitle="+articletitle+"&typeid="+typeid+"&articletype="+articletype+"&articlemsg="+articlemsg+"&articedigest="+articedigest+"&articetag="+articetag,
            success: function(msg){
                var ms = eval('(' + msg + ')');
                if(ms==0)
                {
                    $("#savelabel").show();
                    $("#savelabel").html("文章标题已存在，重新编辑！");
                }
                else
                {
                    var time = new Date();
                    var t = time.getDate() + " " + time.getHours() + ":"
                            + time.getMinutes() + ":" + time.getSeconds();
                    $("#savelabel").html("文章已保存为草稿&nbsp;&nbsp;"+t);
                    $("#savelabel").show();
                    $("#articleid").val(ms);
                }
            }
        });
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
        <a href="#"></a><b>博客管理后台</b></a>. 刘单风专用后台
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
<!-- 富文本编辑器配置文件 -->
<script type="text/javascript" src="/static/admin/ueditor/ueditor.config.js"></script>
<!-- 富文本编辑器源码文件 -->
<script type="text/javascript" src="/static/admin/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript" src="/static/admin/js/DatePicker/WdatePicker.js"></script>
<script>
    //文章封面图上传
    $('#coverimgupload').click(function(){
        document.articleform.action="/admin/fileupload";
        document.articleform.target="coverframe";
        document.articleform.submit();
    });

    $('#publicbtn').click(function(){
        document.articleform.action="/admin/doAddarticle";
        document.articleform.target="";
        document.articleform.submit();
    });

</script>
<script>
    var articlemsg = UE.getEditor('articlemsg',{autoHeightEnabled:false});
</script>
</body>
</html>