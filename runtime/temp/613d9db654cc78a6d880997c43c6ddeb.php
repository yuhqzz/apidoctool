<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:96:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/admin/view/admin/adddocapi.html";i:1539762689;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/admin/view/layouts/admin.html";i:1539762352;s:49:"../application/admin/view/layouts/htmlheader.html";i:1539745999;s:49:"../application/admin/view/layouts/mainheader.html";i:1539668144;s:45:"../application/admin/view/layouts/menuer.html";i:1539677291;s:49:"../application/admin/view/layouts/htmlfooter.html";i:1539762186;}*/ ?>
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
                        <a href="/admin/types">接口列表
                            <i class="pull-right fa"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/types">项目环境管理
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
                        <a href="/admin/system">用户管理
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
                            <div class="panel-heading"><?php echo !empty($docapi['apiid'])?"编辑":"添加"; ?>接口</div>
<div class="panel-body">
    <form action="/admin/doAddapi" method="POST" onsubmit="return datacheck()"  enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group"  style="clear:both;padding-top:20px;">
                <label for="apiname" >接口名称</label>
                <input type="hidden" id="apiid" name="apiid" value="<?php echo !empty($docapi)?$docapi['apiid']:''; ?>"/>
                <input type="text" id="apiname" name="apiname" value="<?php echo !empty($docapi['api_name'])?$docapi['api_name']:''; ?>" class="form-control" placeholder="请输入接口名称">
            </div>
            <div class="form-group" style="padding-top:20px;float:left;width:40%;">
                <label for="projectid" class="apiformlabel">接口所属项目</label>
                <select style="width:55%" class="form-control" id="projectid" name="projectid" onchange="projectchange()">
                    <option value="0">请选择项目</option>
                    <?php foreach($prolists as $pro): ?>
                    <option value="<?php echo $pro['projectid']; ?>" <?php echo !empty($proid)?($proid==$pro['projectid'] ? 'selected' : ''):''; ?> ><?php echo $pro['project_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="padding-top:20px;float:left;width:40%;">
                <label for="moduleid" class="apiformlabel">接口所属版块</label>
                <select style="width:55%" class="form-control" id="moduleid" name="moduleid">
                    <option value="0">请选择版块</option>
                    <?php foreach($modules as $module): ?>
                    <option value="<?php echo $module['id']; ?>" <?php echo !empty($moduleid)?($moduleid==$module['id'] ? 'selected' : ''):''; ?> ><?php echo $module['module_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="apiinfo">接口介绍</label>
                <textarea id="apiinfo" name="apiinfo" class="form-control" placeholder="请输入接口介绍"><?php echo !empty($docapi['api_info'])?$docapi['api_info']:''; ?></textarea>
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="apiurl">接口正式地址</label>
                <input type="text" id="apiurl" name="apiurl" value="<?php echo !empty($docapi['api_url'])?$docapi['api_url']:''; ?>" class="form-control" placeholder="请输入接口正式地址">
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="apitesturl">接口测试地址</label>
                <input type="text" id="apitesturl" name="apitesturl" value="<?php echo !empty($docapi['api_test_url'])?$docapi['api_test_url']:''; ?>" class="form-control" placeholder="请输入接口测试地址">
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;width:40%;float: left">
                <label for="apiformat" class="apiformlabel">接口支持格式</label>
               <input style="width:55%;" type="text" value="JSON" name="apiformat" id="apiformat" class="form-control"/>
            </div>


            <div class="form-group" style="padding-top:10px;width:40%;float: left">
                <label for="apirequest" class="apiformlabel">接口请求方式</label>
                <select onchange="requestchange(this.value)" class="form-control" id="apirequest" name="apirequest" style="width:55%;float:left">
                    <option value="-1" <?php echo !empty($docapi)?'':'selected'; ?>>请选择</option>
                    <option value="0" <?php echo !empty($docapi)?$docapi['api_request']==0 ? 'selected' : '':''; ?>>GET</option>
                    <option value="1" <?php echo !empty($docapi)?$docapi['api_request']==1 ? 'selected' : '':''; ?>>POST</option>
                    <option value="2" <?php echo !empty($docapi)?$docapi['api_request']==2 ? 'selected' : '':''; ?>>PUT</option>
                    <option value="2" <?php echo !empty($docapi)?$docapi['api_request']==3 ? 'selected' : '':''; ?>>DELETE</option>
                </select>
            </div>

            <div class="form-group" style="clear:both;bpadding-top:10px;">
                <label>接口请求参数&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="addreqRow()">
                    <i class="fa fa-edit" title="添加参数"></i> </a>
                </label>
                <table class="table table-hover dataTable" >
                    <thead>
                    <tr>
                        <th>参数名称</th>
                        <th>参数类型</th>
                        <th>是否必填</th>
                        <th>最大长度</th>
                        <th>参数描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="reqparamtable">
                    <?php foreach($docapi['req_params'] as $reqparam): ?>
                    <tr>
                        <td><input type='text' name='reqname[]' value="<?php echo $reqparam['param_name']; ?>" class='form-control' placeholder='参数名称'/></td>
                        <td><input type='text' name='reqtype[]' value="<?php echo $reqparam['param_type']; ?>"  class='form-control' placeholder='参数类型'/></td>
                        <td>
                            <select class="form-control"  name="reqisrequired[]" style="width:80%;float:left">
                                <option value="0" <?php echo !empty($reqparam)?$reqparam['is_required']==0 ? 'selected' : '':''; ?>>必填</option>
                                <option value="1" <?php echo !empty($reqparam)?$reqparam['is_required']==1 ? 'selected' : '':''; ?>>可选</option>
                                <option value="2" <?php echo !empty($reqparam)?$reqparam['is_required']==2 ? 'selected' : '':''; ?>>特殊可选</option>
                            </select>
                        </td>
                        <td><input type='text' name='reqmaxlenth[]' value="<?php echo $reqparam['max_length']; ?>" class='form-control' placeholder='最大长度' /></td>
                        <td><input type='text' name='reqinfo[]' value="<?php echo $reqparam['param_info']; ?>" class='form-control' placeholder='参数描述'/></td>
                        <td><a href='javascript:void(0)' onclick='removeRow(this,0);'><i class="fa fa-trash-o fa-fw" style="font-size: 20px;"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>


            </div>

            <div class="form-group" style="padding-top:10px;">
                <label>接口响应参数&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="addresRow()">
                        <i class="fa fa-edit" title="添加参数"></i> </a></label>
                <table class="table table-hover dataTable" >
                    <thead>
                    <tr>
                        <th>参数名称</th>
                        <th>参数类型</th>
                        <th>是否必填</th>
                        <th>最大长度</th>
                        <th>参数描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="resparamtable">
                    <?php foreach($docapi['res_params'] as $resparam): ?>
                    <tr>
                        <td><input type='text' name='resname[]' value="<?php echo $resparam['param_name']; ?>" class='form-control' placeholder='参数名称'/></td>
                        <td><input type='text' name='restype[]' value="<?php echo $resparam['param_type']; ?>"  class='form-control' placeholder='参数类型'/></td>
                        <td>
                            <select class="form-control" name="resisrequired[]" style="width:80%;float:left">
                                <option value="0" <?php echo !empty($docapi['res_params'])?$docapi['res_params']['is_required']==0 ? 'selected' : '':''; ?>>必填</option>
                                <option value="1" <?php echo !empty($docapi['res_params'])?$docapi['res_params']['is_required']==1 ? 'selected' : '':''; ?>>可选</option>
                                <option value="2" <?php echo !empty($docapi['res_params'])?$docapi['res_params']['is_required']==2 ? 'selected' : '':''; ?>>特殊可选</option>
                            </select>
                        </td>
                        <td><input type='text' name='resmaxlenth[]' value="<?php echo $resparam['max_length']; ?>" class='form-control' placeholder='最大长度' /></td>
                        <td><input type='text' name='resinfo[]' value="<?php echo $resparam['param_info']; ?>" class='form-control' placeholder='参数描述'/></td>
                        <td><a href='javascript:void(0)' onclick='removeRow(this,1);'><i class="fa fa-trash-o fa-fw" style="font-size: 20px;"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="successresult">请求成功实例</label>
                <textarea id="successresult" name="successresult" class="form-control" placeholder="请输入接口请求成功示例"><?php echo !empty($docapi['success_result'])?$docapi['success_result']:''; ?></textarea>
            </div>

            <div class="form-group" style="clear:both;padding-top:10px;">
                <label for="failedresult">请求失败实例</label>
                <textarea id="failedresult" name="failedresult" class="form-control" placeholder="请输入接口请求失败示例"><?php echo !empty($docapi['failed_result'])?$docapi['failed_result']:''; ?></textarea>
            </div>

            <div class="form-group" style="text-align: center">

                <button type="submit" style="margin-right:10%;" class="btn btn-primary">立即保存</button>
                <span id="savelabel" style="display: none;padding:5px;margin-left:10%;border:1px solid #FFCC00;background-color: #FFFFCC;color:#008000"></span>
            </div>
        </div>
    </form>
</div>
<script>

    //增加请求参数
    function addreqRow()
    {
        var row=document.getElementById("reqparamtable").rows.length;
        var newRow = document.getElementById("reqparamtable").insertRow(row);

//得到表的对象并插入一行，下面是插入了行以后，填充相应的列节点，如下面所示
        var oCell = newRow.insertCell(0);//插入列的节点
        oCell.innerHTML = "<input type='text' name='reqname[]' class='form-control' placeholder='参数名称'/>";//列里面填充的值，innerHtml值列内的所有元素

        oCell = newRow.insertCell(1);
        oCell.innerHTML="<input type='text' name='reqtype[]'  class='form-control' placeholder='参数类型'/>";

        oCell=newRow.insertCell(2);
        oCell.innerHTML = " <select class='form-control'  name='reqisrequired[]' style='width:80%;float:left'> <option value='0'>必填</option><option value='1'>可选</option> <option value='2'>特殊可选</option></select>";

        oCell=newRow.insertCell(3);
        oCell.innerHTML = "<input type='text' name='reqmaxlenth[]' class='form-control' placeholder='最大长度' />";

        oCell=newRow.insertCell(4);
        oCell.innerHTML = "<input type='text' name='reqinfo[]' class='form-control' placeholder='参数描述'/>";

        oCell=newRow.insertCell(5);
        oCell.innerHTML = "<a href='javascript:void(0)' onclick='removeRow(this,0);'><i class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a>";

    }

    //增加响应参数
    function addresRow()
    {
        var row=document.getElementById("resparamtable").rows.length;
        var newRow = document.getElementById("resparamtable").insertRow(row);

//得到表的对象并插入一行，下面是插入了行以后，填充相应的列节点，如下面所示
        var oCell = newRow.insertCell(0);//插入列的节点
        oCell.innerHTML = "<input type='text' name='resname[]' class='form-control' placeholder='参数名称'/>";//列里面填充的值，innerHtml值列内的所有元素

        oCell = newRow.insertCell(1);
        oCell.innerHTML="<input type='text' name='restype[]'  class='form-control' placeholder='参数类型'/>";

        oCell=newRow.insertCell(2);
        oCell.innerHTML = " <select class='form-control'  name='resisrequired[]' style='width:80%;float:left'> <option value='0'>必填</option><option value='1'>可选</option> <option value='2'>特殊可选</option></select>";

        oCell=newRow.insertCell(3);
        oCell.innerHTML = "<input type='text' name='resmaxlenth[]' class='form-control' placeholder='最大长度' />";

        oCell=newRow.insertCell(4);
        oCell.innerHTML = "<input type='text' name='resinfo[]' class='form-control' placeholder='参数描述'/>";

        oCell=newRow.insertCell(5);
        oCell.innerHTML = "<a href='javascript:void(0)' onclick='removeRow(this,1);'><i class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a>";

    }

    //删除参数
    function removeRow(src,obj)
    {
        var oRow = src.parentElement;  //获取当前事件的父节点
        if(obj==0){
            var table="reqparamtable";
        }else{
            var table="resparamtable";
        }
        document.getElementById(table).deleteRow(oRow.rowIndex);  //删除当前列
    }


    //提交验证
    function datacheck() {
        var apiname=$("#apiname").val();
        var articletitle=$("#articletitle").val();
        var typeid=$("#typeid").val();
        if(apiname=="") {
            alert("请输入接口名称");
            return false;
        }
    }

    //更改项目,重新加载项目版块
    function projectchange(){
        var proid = $("#projectid").find('option:selected').val();
        $.ajax({
            type: "POST",
            url: "/admin/getModuleByproid",
            data:"proid="+proid,
            success: function(msg){
                var up = $("#moduleid");
                $("option",up).remove(); //清空原有的选项
                var option1 = "<option value='0'>接口所属版块</option>";
                up.append(option1);
                $.each(msg,function(index,array){
                    var option = "<option value='"+array['id']+"'>"+array['module_name']+"</option>";
                    up.append(option);
                });
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