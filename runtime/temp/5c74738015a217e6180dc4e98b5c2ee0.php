<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:88:"/Users/liudanfeng/Documents/www/blog/public/../application/index/view/index/aboutme.html";i:1503300356;s:81:"/Users/liudanfeng/Documents/www/blog/application/index/view/layouts/twoindex.html";i:1503300356;s:49:"../application/index/view/layouts/htmlheader.html";i:1503300356;s:48:"../application/index/view/layouts/htmltitle.html";i:1503300356;s:47:"../application/index/view/layouts/htmlmain.html";i:1503300356;s:52:"../application/index/view/layouts/twohtmlfooter.html";i:1503300356;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="sixapart-standard">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="generator" content="Movable Type  5.2.2" />
<meta name="description" content="<?php echo !empty($nowlocation['pagedesc'])?$nowlocation['pagedesc']:'刘小莫的日志博客'; ?>"/>
<meta name="keywords" content="<?php echo !empty($nowlocation['pagekeywords'])?$nowlocation['pagekeywords']:'刘小莫的日志博客'; ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script type="text/javascript" src="/static/admin/plugins/jQuery/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/admin/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" />
<script type="text/javascript" src="/static/admin/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?f7264d5fa672e198cf2004907faf1ccf";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

<script>
    //增加文章分享次数
    function updatesharenum(cmd)
    {
        $.ajax({
            type: "POST",
            url: "/blog/doshare",
            data:"dataid="+<?php echo !empty($article['ArticleID'])?$article['ArticleID'] : 0; ?>,
            success: function(msg){}
        });
    }
    //第三方分享代码插件
    window._bd_share_config = {
        "common": {
            onAfterClick: updatesharenum
        }, "share": {}
    }
    with(document)0[
            (getElementsByTagName('head')[0]||body).
            appendChild(createElement('script')).
                    src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)
            ];

    /**
     * 全网搜索提交
     */
    function searchsubmit()
    {
        $("#selform").submit();
    }

    /**
     * 标签搜索
     * @param obj
     */
   function tagsubmit(obj)
   {
       $("#tagform"+obj).submit();
   }
    SyntaxHighlighter.all();
</script>
<link rel="stylesheet" href="/static/home/css/styles.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="/static/admin/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/static/home/css/animation.css" />
<title><?php echo !empty($nowlocation['blogtitle'])?$nowlocation['blogtitle']:'刘小莫的日志博客'; ?></title>
</head>
<body id="scrapbook" class="mt-main-index two-columns">
<div id="blogheader">
    <div style="float: left;width:70%">
        <h1><?php echo $blogdata['BlogTitle']; ?></h1>
        <p><?php echo $blogdata['BlogInfo']; ?></p>
    </div>
    <div id="google_search" style="float: left;line-height: 80px;">
        <!-- 全站查询start -->
        <form id="selform" action="/blog" id="cse-search-box"  method="post">
            <div>
                <input type="text" onkeydown='if(event.keyCode==13){searchsubmit();}' name="keywords" class="searchbox" placeholder="请输入搜索关键词">
            </div>
        </form>
        <!-- 全站查询end -->
    </div>
</div>
<div class="headhr"></div>
<div id="container">
    <div id="container-inner">
        <div id="content">
            <!--网页导航-->
<div class="breadcrumbs">
    <a title="返回首页" href="/blog"><i class="fa fa-home"></i></a>
    <small>&gt;</small>
    <a href="/blog">首页</a>
    <?php if($nowlocation): if($nowlocation['onemsg']): ?>
    <small>&gt;</small>
    <span class="muted"><a href="<?php echo !empty($nowlocation['oneurl'])?$nowlocation['oneurl']:'#'; ?>"><?php echo !empty($nowlocation['onemsg'])?$nowlocation['onemsg']:''; ?></a></span>
    <?php endif; ?>
    <small>&gt;</small>
    <span class="muted"><?php echo !empty($nowlocation)?$nowlocation['lastmsg']:''; ?></span>
    <?php endif; ?>
    <!--滚动公告start-->
    <div class="speedbar">
        <ul>
            <li><a>如果你觉得博客还不错，请Ctrl+D收藏(*^__^*)</a></li>
            <li><a>如有大神光临请不要黑我的网站(ಥ _ ಥ)</a></li>
            <li><a>PHP是世界上最好的语言，有任何问题都可以留言一起探究</a></li>
        </ul>
    </div>
    <!--滚动公告end-->
</div>
            <div id="content-inner">
                
<div class="aboutme">
    <h3>About Me</h3>
    <div class="divhr"></div>
    <div class="coutent">
        My name is Liu XiaoMo(刘小莫). You can call me MoMo. I was born in 1990s.
        I am an IT developer focusing on web technology and PHP. Now I am in wuxi medical library software technology co., LTD. PHP software engineer.
        In spare time, I like reading book, surfing internet,travel,play table tennis and outdoor running.
    </div>
    <h3>External Links</h3>
    <div class="divhr"></div>
    <div class="coutent">
        <a href="mailto:xirizhifeng@163.com" title="欢迎发邮件学术探讨哦">xirizhifeng@163.com</a>&nbsp;&nbsp;&nbsp;
        <a target=_blank href="http://weibo.com/2815473314" title="去我微博看看吧">微博</a>&nbsp;&nbsp;&nbsp;
        <a target=_blank href="https://github.com/zhuifengxia" title="资源共享哦">GitHub</a>&nbsp;&nbsp;&nbsp;
        <a target=_blank href="http://blog.csdn.net/momo_mutou" title="我还有CSDN哦">CSDN</a>&nbsp;&nbsp;&nbsp;
        <a target=_blank href="/gossips" title="我的胡言乱语。。。">有句话要说</a><br/>
        <img alt="扫我关注我哦" title="扫我关注我哦" src="/static/home/images/wechatcode.png" width="150" height="150"/>
    </div>
</div>
            </div>
        </div>
        <script type="text/javascript" src="/static/home/js/dropload.min.js"></script>
<!--页脚start-->
<div id="footer">
    <div id="footer-inner">
        <div id="footer-content">
            <p><a href="/contact.html">联系方式</a> | liuxiaomo.cn 2003 - 2017</p>
        </div>
    </div>
</div>
<!--页脚end-->

<script>
    function autoScroll(obj){
        $(obj).find("ul").animate({
            marginTop : "-39px"
        },500,function(){
            $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
        })
    }
    $(function(){
        setInterval('autoScroll(".speedbar")',2000);
    });

</script>
<!--留言板加载更多start-->
<script type="text/javascript">
    $(function(){
        var articleid=$("#articleid").val();
        // 页数
        var page = 1;
        // dropload
        $('#postcomments').dropload({
            scrollArea : window,
            domUp : {
                domClass   : 'dropload-up',
                domRefresh : '<div class="dropload-refresh">↓下拉刷新</div>',
                domUpdate  : '<div class="dropload-update">↑释放更新</div>',
                domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
            },
            domDown : {
                domClass   : 'dropload-down',
                domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
                domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                domNoData  : '<div class="dropload-noData">没有更多数据了</div>'
            },
            loadDownFn : function(me){
                page++;
                $.ajax({
                    type: 'POST',
                    url: '/blogwordsnext',
                    data:"cpage="+page+"&articleid="+articleid,
                    dataType:"html",
                    success: function(data){
                        if(data){
                        }else{
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            // 插入数据到页面，放到最后面
                            $('.commentlist').append(data);
                            // 每次数据插入，必须重置
                            me.resetload();
                        },1000);
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                        // 即使加载出错，也得重置
                        me.resetload();
                    }
                });
            },
            threshold : 50
        });

        b();
        $('#gotop').click(function(){
            $(document).scrollTop(0);
        });
        function b(){
            h = $(window).height();
            t = $(document).scrollTop();
            if(t > h){
                $('#gotop').show();
            }else{
                $('#gotop').hide();
            }
        }

        $(window).scroll(function(e){
            b();
        });

    });
</script>
<!--留言板加载更多end-->

<!--碎语加载更多start-->
<script type="text/javascript">
    $(function(){
        // 页数
        var page = 2;
        // dropload
        $('#gossiplist').dropload({
            scrollArea : window,
            domUp : {
                domClass   : 'dropload-up',
                domRefresh : '<div class="dropload-refresh">↓下拉刷新</div>',
                domUpdate  : '<div class="dropload-update">↑释放更新</div>',
                domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
            },
            domDown : {
                domClass   : 'dropload-down',
                domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
                domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                domNoData  : '<div class="dropload-noData">没有更多数据了</div>'
            },
            loadDownFn : function(me){
                page++;
                $.ajax({
                    type: 'POST',
                    url: '/gossipsnext',
                    data:"cpage="+page,
                    dataType:"html",
                    success: function(data){
                        if(data){
                        }else{
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            // 插入数据到页面，放到最后面
                            $('.archives-monthlisting').append(data);
                            // 每次数据插入，必须重置
                            me.resetload();
                        },1000);
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                        // 即使加载出错，也得重置
                        me.resetload();
                    }
                });
            },
            threshold : 50
        });

        b();
        $('#gotop').click(function(){
            $(document).scrollTop(0);
        });
        function b(){
            h = $(window).height();
            t = $(document).scrollTop();
            if(t > h){
                $('#gotop').show();
            }else{
                $('#gotop').hide();
            }
        }

        $(window).scroll(function(e){
            b();
        });

    });
</script>
<!--碎语加载更多end-->
    </div>
</div>
</body>
</html>