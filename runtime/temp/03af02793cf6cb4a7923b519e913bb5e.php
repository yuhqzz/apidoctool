<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:85:"/Users/liudanfeng/Documents/www/blog/public/../application/index/view/blog/index.html";i:1503300356;s:78:"/Users/liudanfeng/Documents/www/blog/application/index/view/layouts/index.html";i:1503300356;s:49:"../application/index/view/layouts/htmlheader.html";i:1503300356;s:48:"../application/index/view/layouts/htmltitle.html";i:1503300356;s:47:"../application/index/view/layouts/htmlmain.html";i:1503300356;s:48:"../application/index/view/layouts/htmlright.html";i:1503300356;s:49:"../application/index/view/layouts/htmlfooter.html";i:1503300356;s:52:"../application/index/view/layouts/twohtmlfooter.html";i:1503300356;}*/ ?>
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
                <div id="alpha" class="articlelist">
                    <div id="alpha-inner" class="articdata">
                        <input type="hidden" id="typeid" name="typeid" value="<?php echo $typeid; ?>"/>
<?php foreach($articledata as $article): ?>
<article class="excerpt">
    <header>
        <a class="label label-yuanchuang" style="background-color:<?php echo !empty($article['ArticleType'])?'#777':'#5cb85c'; ?>"  href="#"><?php echo !empty($article['ArticleType'])?'转载':'原创'; ?></a>
        <?php if($article['TypeName']): ?>
        <a class="label label-important" href="/blog/<?php echo $article['TypeID']; ?>"><?php echo $article['TypeName']; ?><i class="label-arrow"></i></a>
        <?php endif; ?>
        <h2><a href="/blog/article/<?php echo $article['ArticleID']; ?>" title="<?php echo $article['ArticleTitle']; ?>"><?php echo $article['ArticleTitle']; ?></a></h2>
    </header>
    <div class="focus">
        <a target="_blank" href="#">
            <img class="thumb" style="width:200px;height:123px;margin-bottom:20px;" src="<?php echo $article['ArticleImg']; ?>" alt="<?php echo $article['ArticleTitle']; ?>">
        </a>
    </div>
        <span class="note"><?php echo !empty($article['ArticleMsg'])?(mb_strlen(strip_tags($article['ArticleMsg']),'UTF8')>=300 ? mb_substr(strip_tags($article['ArticleMsg']),0,300).'。。。' : strip_tags($article['ArticleMsg'])):''; ?>
           &nbsp;&nbsp;&nbsp; <a href="/blog/article/<?php echo $article['ArticleID']; ?>" rel="nofollow" class="more-link">继续阅读 »</a>
        </span>
    <br/><br/>
    <p class="auth-span">
        <span class="muted"><i class="fa fa-user"></i> <a href="#">刘小莫</a></span>
        <span class="muted"><i class="fa fa-clock-o"></i> <?php echo $article['PublishTime']; ?></span>
        <span class="muted"><i class="fa fa-eye"></i> <?php echo $article['ReadNum']; ?>浏览</span>
        <span class="muted"><a href="javascript:;" onclick="likeoperation(1,<?php echo $article['ArticleID']; ?>)" class="action"><i class="fa <?php echo !empty($article['IsLike'])?'fa-heart':'fa-heart-o'; ?>" id="artlikenumi<?php echo $article['ArticleID']; ?>"></i><font id="artlikenum<?php echo $article['ArticleID']; ?>"><?php echo $article['LikeNum']; ?></font>个赞</a></span></p>
</article>
<?php endforeach; ?>
                    </div>
                </div>
                <!--右边数据栏start-->
<div id="beta">
    <div id="beta-inner">
        <div class="likeme" id="likeoper" onclick="likeoperation(0,0)">
            <span id="likemsg">Do you like me ?</span><br/>
            <span id="likenum"><?php echo $weblikenum; ?></span>
        </div>

        <!--关于我start-->
        <div class="module-categories module">
            <h2 class="module-header">关于</h2>
            <div class="module-content">
                <ul class="module-list">
                    <li class="module-list-item" style="margin-top:5px;float:left;margin-right:10px;">
                        <a href="/static/userimg.jpg" onclick="window.open('/static/userimg.jpg','popup','width=480,height=640,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false">
                            <img src="/static/userimg.jpg" width="80" height="90" alt="个人照片" />
                        </a>
                    </li>
                    <li class="module-list-item"><a href="/aboutme">个人简介</a>，<a target=_blank href="http://weibo.com/2815473314">微博</a></li>
                    <li class="module-list-item"><a target=_blank href="https://github.com/zhuifengxia">GitHub</a>，<a target=_blank href="/blogwords">留言板</a></li>
                    <li class="module-list-item"><a href="mailto:xirizhifeng@163.com">xirizhifeng@163.com</a></li>
                </ul>

            </div>
            <div style="margin-left:1em">文章：<?php echo $articlenum; ?>&nbsp;&nbsp;&nbsp;留言：<?php echo $postnum; ?>&nbsp;&nbsp;&nbsp;用户：<?php echo $usernum; ?><br/>建站日期：2016-12-23&nbsp;&nbsp;运行天数：<?php echo $publictime; ?><br/>最后更新：<?php echo date("y-m-d",$lasttime); ?></div>
        </div>
        <!--关于我end-->

        <!--分类目录start-->
        <div class="module-type module">
            <h2 class="module-header">分类目录</h2>
            <div class="module-content">
                <ul class="module-list">
                    <?php foreach($typelst as $type): ?>
                    <li class="module-list-item">
                        <a href="/blog/<?php echo $type['TypeID']; ?>"><?php echo $type['TypeName']; ?>&nbsp;<span>(<?php echo $type['ArticleNum']; ?>)</span></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!--分类目录end-->
        <div style="clear: both;"></div>

        <!--最新评论start-->
        <div class="module-comments module"  id="latest-comments">
            <h2 class="module-header">最新评论</h2>
            <div class="module-content">
                <ul>
                    <?php foreach($postdata as $post): ?>
                    <li>
                        <img class="commentimg" src="<?php echo !empty($post['ImgUrl'])?$post['ImgUrl']:'/homeback/35.jpg'; ?>">
                        <div class="commentcss"><i><?php echo !empty($post['PostName'])?$post['PostName']:'匿名用户'; ?></i><?php echo date("m-d",$post['PostDate']); ?>说：<?php echo $post['PostContent']; ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!--最新评论end-->

    </div>
</div>
<!--右边数据栏end-->
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
<script type="text/javascript" src="/static/home/js/dropload.min.js"></script>
<?php if(!$nojs): ?>
<!--文章列表加载代码start-->
<script type="text/javascript">
    $(function(){
        // 页数
        var page = 1;
        var typeid=$("#typeid").val();
        var keywords="<?php echo !empty($selkeyword)?$selkeyword:''; ?>";
        // dropload
        $('.articlelist').dropload({
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
                    url: '/blog/articlenext',
                    data:"cpage="+page+"&typeid="+typeid+"&keywords="+keywords,
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
                            $('.articdata').append(data);
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
<!--文章列表加载代码end-->
<?php endif; ?>

<script type="text/javascript">
    if (/mobile/i.test(navigator.userAgent) || /android/i.test(navigator.userAgent)) document.body.classList.add('mobile');

    /*网站点赞/文章点赞/评论点赞*/
    function likeoperation(datatype,dataid)
    {
        $.ajax({
            type: "POST",
            url: "/blog/dolike",
            data:"datatype="+datatype+"&dataid="+dataid,
            success: function(msg){
                var ms = eval('(' + msg + ')');
                if(ms==0)
                {
                    if(datatype==0)
                    {
                        $("#likemsg").html("已经收到你的 ❤ 啦");
                    }
                    else if(datatype==1)
                    {
                        $("#artlikenumi"+dataid).addClass("fa-heart");
                        $("#artlikenumi"+dataid).removeClass("fa-heart-o");
                    }
                }
                else {
                    if (datatype == 0) {
                        var msg = ["I ❤ you too (*￣▽￣*)", "你很有眼光哇\(^o^)/", "你太帅嘞︿(￣︶￣)︿", "PHP是最好的语言^O^", "喜欢我就收藏我(∩_∩)"];
                        var likemsg = msg[Math.floor(Math.random() * msg.length)];
                        $("#likemsg").html(likemsg);
                        var likenum = $("#likenum").html();
                        if(likenum==0) {
                            $("#likenum").html(1);
                        }else {
                            $("#likenum").html(parseInt(likenum) + 1);
                        }
                    }else if(datatype==1){
                        var artnum=$("#artlikenum"+dataid).text();
                        if(artnum==""||artnum==0)
                        {
                            $("#artlikenum"+dataid).text(1);
                        }else{
                            $("#artlikenum"+dataid).text(parseInt(artnum)+1);
                        }
                        $("#artlikenumi"+dataid).addClass("fa-heart");
                        $("#artlikenumi"+dataid).removeClass("fa-heart-o");
                    }
                }
            }
        });
    }
</script>

    </div>
    <a id="gotop" href="javascript:void(0)"><img src="/static/home/images/fhjt.png" alt=""/></a>
</div>
<div class="fancybox-overlay fancybox-overlay-fixed" style="width: 100%; height: 4054px; "></div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#showdiv").click(function(e){
            e.stopPropagation();
            $(".fancybox-wrap").show();
            $(".fancybox-overlay").show();
        });
        $(document).click(function(){
            if(!$(".fancybox-wrap").is(":hidden")){
                $(".fancybox-wrap").hide();
                $(".fancybox-overlay").hide();
            }
        });
    });
</script>
</body>
</html>