<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:95:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/docapi/apitest.html";i:1540211924;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1539859787;s:49:"../application/index/view/layouts/htmlheader.html";i:1540204259;s:48:"../application/index/view/layouts/htmltitle.html";i:1540211400;s:49:"../application/index/view/layouts/htmlfooter.html";i:1540204282;}*/ ?>
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
                    <div class="container" style="margin-left:8%">
    <form id="apiform">
        <div class="form-group">
            <label class="apihd">测试地址</label>
            <input type="text" placeholder='请输入测试地址' name="apiurl" class='form-control' value="<?php echo $apidetails['api_url']; ?>"
                   style="width:90%;"/>
        </div>
        <div class="form-group">
            <label class="apihd">请求类型</label>
            <select class="form-control" name="reqtype" style="width:15%;">
                <option value="0">HTTP</option>
                <option value="1">HTTPS</option>
            </select>
        </div>
        <div class="form-group">
            <label class="apihd">请求方式</label>
            <select class="form-control" name="apirequest" style="width:15%;">
                <option value="-1" <?php echo !empty($apidetails)?'':'selected'; ?>>请选择</option>
                <option value="0" <?php echo !empty($apidetails)?$apidetails['api_request']==0 ?
                'selected' : '':''; ?>>GET</option>
                <option value="1" <?php echo !empty($apidetails)?$apidetails['api_request']==1 ?
                'selected' : '':''; ?>>POST</option>
                <option value="2" <?php echo !empty($apidetails)?$apidetails['api_request']==2 ?
                'selected' : '':''; ?>>PUT</option>
                <option value="3" <?php echo !empty($apidetails)?$apidetails['api_request']==3 ?
                'selected' : '':''; ?>>DELETE</option>
            </select>
        </div>
        <div class="form-group">
            <label class="apihd">请求参数&nbsp;&nbsp;<a onclick="addreqRow()"><i class="fa fa-edit"
                                                                             title="添加参数"></i></a></label>
            <div>
                <table class="table table-bordered" style="width:90%;" id="reqparamtable">
                    <th>参数名称</th>
                    <th>参数值</th>
                    <?php if($apidetails): foreach($apidetails['req_params'] as $reqparam): ?>
                    <tr>
                        <td><input type="text" class='form-control' name='reqname[]' value="<?php echo $reqparam['param_name']; ?>"
                                   placeholder='请输入参数名称'/></td>
                        <td><input type="text" class='form-control' name='reqvalue[]' placeholder='请输入参数值'
                                   style='width:80%;float:left'/>
                            <a href='javascript:void(0)' onclick='removeRow(this);'><i
                                    class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td><input type="text" class='form-control' name='reqname[]' placeholder='请输入参数名称'/></td>
                        <td><input type="text" class='form-control' name='reqvalue[]' placeholder='请输入参数值'
                                   style='width:80%;float:left'/>
                            <a href='javascript:void(0)' onclick='removeRow(this);'><i
                                    class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a></td>
                    </tr>
                    <tr>
                        <td><input type="text" class='form-control' name='reqname[]' placeholder='请输入参数名称'/></td>
                        <td><input type="text" class='form-control' name='reqvalue[]' placeholder='请输入参数值'
                                   style='width:80%;float:left'/>
                            <a href='javascript:void(0)' onclick='removeRow(this);'><i
                                    class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a></td>
                    </tr>
                    <tr>
                        <td><input type="text" class='form-control' name='reqname[]' placeholder='请输入参数名称'/></td>
                        <td><input type="text" class='form-control' name='reqvalue[]' placeholder='请输入参数值'
                                   style='width:80%;float:left'/>
                            <a href='javascript:void(0)' onclick='removeRow(this);'><i
                                    class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a></td>
                    </tr>
                    <?php endif; ?>
                </table>

            </div>
        </div>
        <div>
            <input onclick="testsubmit()" type="button" value="提&nbsp;&nbsp;&nbsp;&nbsp;交" class='form-control'
                   style="width:60%;background-color:#3c8dbc;color: white;font-weight: bold;margin-left:12%"/>
        </div>

    </form>


    <div class="form-group">
        <label class="apihd">响应结果</label>
        <ul id="myTab" class="nav nav-tabs apivalue">
            <li class="active"><a href="#resultformat" data-toggle="tab">
                格式化JSON</a>
            </li>
            <li><a href="#originaljson" data-toggle="tab">原始JSON</a></li>
        </ul>

        <div id="myTabContent" class="tab-content apivalue">
            <div class="tab-pane fade in active" id="resultformat" style="margin-top:15px;">
            </div>
            <div class="tab-pane fade in" id="originaljson" style="margin-top:15px;">
            </div>
        </div>

    </div>

</div>

<script>
var resultformat;
    $(document).ready(function () {
        resultformat = function () {
            var options = {
                dom: '#resultformat',
            };
            window.jf = new JsonFormater(options);
            jf.doFormat($('#originaljson').html());
        };
    });


    //增加请求参数
    function addreqRow() {
        var row = document.getElementById("reqparamtable").rows.length;
        var newRow = document.getElementById("reqparamtable").insertRow(row);

//得到表的对象并插入一行，下面是插入了行以后，填充相应的列节点，如下面所示
        var oCell = newRow.insertCell(0);//插入列的节点
        oCell.innerHTML = "<input type='text' name='reqname[]' class='form-control' placeholder='请输入参数名称'/>";//列里面填充的值，innerHtml值列内的所有元素

        oCell = newRow.insertCell(1);
        oCell.innerHTML = "<input type='text' name='reqvalue[]' style='width:80%;float:left'  class='form-control' placeholder='请输入参数值'/><a href='javascript:void(0)' onclick='removeRow(this);'><i class='fa fa-trash-o fa-fw' style='font-size: 20px;'></i></a>";
    }

    //删除参数
    function removeRow(obj) {
        var oRow = obj.parentElement;
        var oRow = oRow.parentElement;  //获取当前事件的父节点
        document.getElementById("reqparamtable").deleteRow(oRow.rowIndex);  //删除当前列
    }

    function testsubmit() {
        $.ajax({
            type: "POST",
            url: "/docapi/doapitest",
            data: $("#apiform").serialize(),
            success: function (msg) {
                $("#originaljson").html(msg);
                resultformat();
            }
        });
    }

</script>
                </div>
            </div>
        </div>
        <div class="Footer">Powered By @<font color="#3c8dbc">liuxiaomo</font></div>
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