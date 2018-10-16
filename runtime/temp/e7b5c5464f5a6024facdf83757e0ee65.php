<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"/Users/liudanfeng/Documents/www/blog/public/../application/activity/view/apiwechat/test.html";i:1517125105;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>人生成绩单</title>
</head>
<body>
<div style="padding-top:100px;width: 35%;margin:0 auto;">
    <span style="font-size: 20px">人生成绩单</span>
</div>

<form action="/wechat/testsubmit" method="post">
    <div>
        姓名 &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username"/><br/>
        性别 &nbsp;&nbsp;&nbsp;&nbsp;
        <select>
            <option value="0">女</option>
            <option value="1">男</option>
        </select>
    </div>
    <br/>
    <a href="weixin://contacts/profile/gh_1876b710729e">aaa</a>
    <input type="submit" value="提交"/>

</form>
</body>
</html>
