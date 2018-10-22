<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"/Users/liudanfeng/Documents/www/apidoctool/public/../application/index/view/docapi/apis.html";i:1540190790;s:84:"/Users/liudanfeng/Documents/www/apidoctool/application/index/view/layouts/index.html";i:1539859787;s:49:"../application/index/view/layouts/htmlheader.html";i:1540176889;s:48:"../application/index/view/layouts/htmltitle.html";i:1539930137;s:49:"../application/index/view/layouts/htmlfooter.html";i:1540192447;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>DocApi</title>
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
                    <!-- jsonforamt -->
<link rel="stylesheet" type="text/css" href="/static/home/css/jsonFormater.css" />
<nav style="width:100%;border-bottom:1px solid #e1e4e8">
    <select class="form-control float-left w160 mr12"
            onchange="self.location.href='/docapi/apis/'+options[selectedIndex].value" style="width:13%">
        <?php foreach($projects as $pro): ?>
        <option <?php echo !empty($pro)?$pro['projectid']==$proid ?
        'selected' : '':''; ?> value="<?php echo $pro['projectid']; ?>"><?php echo $pro['project_name']; ?></option>
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
            <ul class="submenu" style="<?php echo $module['id']==$moduleid?'display:block':''; ?>">
                <?php foreach($module['apis'] as $api): ?>
                <li <?php echo $api['apiid']==$apiid?"class='current'":''; ?>><a href="javascript:void(0)" onclick="showapidetail(<?php echo $api['apiid']; ?>)"><?php echo $api['api_name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<div id="apidetails" style="margin-top: 20px;width:80%;font-size:16px;">
    <h2 id="apiname"><?php echo $apidetails['api_name']; ?></h2>

    <div class="form-group">
        <label class="apihd">应用场景</label>
        <p class="apivalue" id="apiinfo"><?php echo $apidetails['api_info']; ?></p>
    </div>

    <div class="form-group">
        <label class="apihd">请求地址</label>
        <table class="table table-bordered apivalue" style="width:95%;">
            <tr>
                <th>环境</th>
                <th>请求地址</th>
            </tr>
            <tr>
                <td>正式环境</td>
                <td id="apiurl">
                    <?php echo $apidetails['api_url']; ?>
                </td>
            </tr>
            <tr>
                <td>测试环境</td>
                <td id="apitesturl">
                    <?php echo $apidetails['api_test_url']; ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="form-group">
        <label class="apihd">支持格式</label>
        <p class="apivalue" id="apiformat"><?php echo $apidetails['api_format']; ?></p>
    </div>

    <div class="form-group">
        <label class="apihd">请求方式</label>
        <p class="apivalue" id="apirequest"><?php echo $apidetails['api_request']; ?></p>
    </div>

    <div class="form-group">
        <label class="apihd">请求参数</label>
        <table class="table table-bordered apivalue" style="width:95%;" id="reqparam">
            <th>参数名称</th>
            <th>参数类型</th>
            <th>是否必填</th>
            <th>最大长度</th>
            <th>参数描述</th>
            <?php foreach($apidetails['req_params'] as $reqparam): ?>
            <tr>
                <td><?php echo $reqparam['param_name']; ?></td>
                <td><?php echo $reqparam['param_type']; ?></td>
                <td><?php echo $reqparam['is_required']==0?'必填':($reqparam['is_required']==1?'可选':'特殊可选'); ?></td>
                <td><?php echo $reqparam['max_length']==0?'--':$reqparam['max_length']; ?></td>
                <td><?php echo $reqparam['param_info']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="form-group">
        <label class="apihd">响应参数</label>
        <table class="table table-bordered apivalue" style="width:95%;" id="resparam">
            <th>参数名称</th>
            <th>参数类型</th>
            <th>是否必填</th>
            <th>最大长度</th>
            <th>参数描述</th>
            <?php foreach($apidetails['res_params'] as $resparam): ?>
            <tr>
                <td><?php echo $resparam['param_name']; ?></td>
                <td><?php echo $resparam['param_type']; ?></td>
                <td><?php echo $resparam['is_required']==0?'必填':($reqparam['is_required']==1?'可选':'特殊可选'); ?></td>
                <td><?php echo $resparam['max_length']==0?'--':$reqparam['max_length']; ?></td>
                <td><?php echo $resparam['param_info']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="form-group">
        <label class="apihd">响应状态码</label>
        <table class="table table-bordered apivalue" style="width:95%;" id="statecode">
            <th>状态值(status)</th>
            <th>状态描述(msg)</th>
            <th>原因</th>
            <th>解决方案</th>
            <tr>
                <td>0</td>
                <td>成功</td>
                <td>你和医库很有缘</td>
                <td>继续保持这种缘分</td>
            </tr>
            <tr>
                <td>1</td>
                <td>失败/参数不全</td>
                <td>缺少了某个请求参数</td>
                <td>检查下你少传了啥参数</td>
            </tr>
            <tr>
                <td>2</td>
                <td>token过期</td>
                <td>可能你账号被别人登录了</td>
                <td>重新登录获取token</td>
            </tr>

            <?php foreach($apidetails['state_codes'] as $statecode): ?>
            <tr>
                <td><?php echo $statecode['state_name']; ?></td>
                <td><?php echo $statecode['state_info']; ?></td>
                <td><?php echo $statecode['state_reason']; ?></td>
                <td><?php echo $statecode['state_solution']; ?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>

    <div class="form-group">
        <label class="apihd">响应示例</label>
        <ul id="myTab" class="nav nav-tabs apivalue">
            <li class="active"><a href="#successformat" data-toggle="tab">
                成功示例</a>
            </li>
            <li><a href="#failedformat" data-toggle="tab">失败示例</a></li>
        </ul>

        <div id="myTabContent" class="tab-content apivalue">
            <textarea id="successcode" style="display: none"><?php echo $apidetails['success_result']; ?></textarea>
            <div class="tab-pane fade in active" id="successformat" style="margin-top:15px;">
            </div>
            <textarea id="failedcode" style="display: none"><?php echo $apidetails['failed_result']; ?></textarea>
            <div class="tab-pane fade" id="failedformat"  style="margin-top:15px;">
            </div>

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

<script type="text/javascript" src="/static/home/js/jsonFormater.js"></script>

<script type="application/javascript">
    var successjsonformat;
    var failedjsonformat
    $(document).ready(function () {
        successjsonformat = function () {
            var options = {
                dom: '#successformat',
            };
            window.jf = new JsonFormater(options);
            jf.doFormat($('#successcode').val());
        };
        failedjsonformat = function () {
            var options = {
                dom: '#failedformat',
            };
            window.jf = new JsonFormater(options);
            jf.doFormat($('#failedcode').val());
        };
        successjsonformat();
        failedjsonformat();
    });

    //获取接口详情
    function showapidetail(apiid){
        $.ajax({
            type: "POST",
            url: "/docapi/details",
            data:"apiid="+apiid,
            success: function(msg){
                $("#apiname").html(msg.api_name);
                $("#apiinfo").html(msg.api_info);
                $("#apiurl").html(msg.api_url);
                $("#apitesturl").html(msg.api_test_url);
                $("#apiformat").html(msg.api_format);
                $("#apirequest").html(msg.api_request);
                $("#reqparam tr:gt(0)").remove();
                $.each(msg.req_params,function(index,array){
                    var trhtml="<tr><td>"+array.param_name+"</td><td>"+array.param_type+"</td><td>"+(array.is_required==0?'必填':(array.is_required==1?'可选':'特殊可选'))+"</td><td>"+(array.max_length==0?'--':array.max_length)+"</td><td>"+array.param_info+"</td></tr>";
                    $("#reqparam tbody").append(trhtml);
                });

                $("#resparam tr:gt(0)").remove();
                $.each(msg.res_params,function(index,array){
                    var trhtml="<tr><td>"+array.param_name+"</td><td>"+array.param_type+"</td><td>"+(array.is_required==0?'必填':(array.is_required==1?'可选':'特殊可选'))+"</td><td>"+(array.max_length==0?'--':array.max_length)+"</td><td>"+array.param_info+"</td></tr>";
                    $("#resparam tbody").append(trhtml);
                });


                $("#statecode tr:gt(3)").remove();
                $.each(msg.state_codes,function(index,array){
                    var trhtml="<tr><td>"+array.state_name+"</td><td>"+array.state_info+"</td><td>"+array.state_reason+"</td><td>"+array.state_solution+"</td></tr>";
                    $("#statecode tbody").append(trhtml);
                });
                $("#successcode").html(msg.success_result);
                $("#failedcode").html(msg.failed_result);

                successjsonformat();
                failedjsonformat();
            }
        });
    }
</script>
    </article>
</div>
</body>
</html>