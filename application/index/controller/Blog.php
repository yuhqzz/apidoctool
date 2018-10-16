<?php
/**
 * 博客文章展示相关代码
 * 作者：刘单风
 * 最后修改时间：2017-03-15
 * 版权：刘单风
 */
namespace app\index\controller;
use app\common\model\Common;
use think\Controller;
use think\Db;

class Blog extends Controller
{
    /**
     * 博客首页
     */
    public function index($typeid=0)
    {
        $selkeywords = isset($_REQUEST['keywords']) ? $_REQUEST['keywords'] : "";
        $istag = isset($_REQUEST['istag']) ? $_REQUEST['istag'] : 0;
        $location = [];
        //当前位置
        if ($typeid) {
            //获取当前分类的名字
            $typename = Db::table('article_type')
                ->where('TypeID', $typeid)
                ->find();
            $location = ['pagekeywords'=>$typename['TypeName'],'pagedesc'=>$typename['TypeName'].'相关文章','onemsg' => '', 'lastmsg' => $typename['TypeName']];
        }
        if ($selkeywords) {
            $location = ['pagekeywords'=>$selkeywords,'pagedesc'=>'有关【' . $selkeywords . '】的内容','onemsg' => '', 'lastmsg' => '有关【' . $selkeywords . '】的内容'];
        }
        if($istag)
        {
            $location = ['pagekeywords'=>$selkeywords,'pagedesc'=>'标签:【' . $selkeywords . '】','onemsg' => '', 'lastmsg' => '标签：【' . $selkeywords . '】'];
        }
        $this->assign('nowlocation', $location);
        //获取博客配置信息
        $blogdata = Common::blogconfig();
        $this->assign('blogdata', $blogdata);
        //获取网站通用数据
        $blogcommdata = Common::blogcommdata();
        //获取喜欢网站的总人数
        $this->assign('weblikenum', $blogcommdata['weblikenum']);
        //获取文章总数
        $this->assign('articlenum', $blogcommdata['articlenum']);
        //用户总数
        $this->assign('usernum', $blogcommdata['usernum']);
        //最后更新时间
        $this->assign('lasttime', $blogcommdata['lasttime']);
        //网站发布时间
        $this->assign('publictime', $blogcommdata['publictime']);
        //获取留言总数
        $this->assign('postnum', $blogcommdata['postnum']);
        //获取分类目录以及目录下的文章数量
        $this->assign('typelst', $blogcommdata['typelst']);
        //获取最新的5条评论
        $this->assign('postdata', $blogcommdata['lastcomment']);
        //搜索关键词
        $this->assign('selkeyword', $selkeywords);
        //获取最新的10条文章
        $articledata = Common::articlelst($typeid, 1, $selkeywords);
        $this->assign('articledata', $articledata);
        $this->assign('typeid', $typeid);
        return $this->fetch('index');
    }

    /**
     * 喜欢网站操作
     */
    public function doLike()
    {
        $clientip=$_SERVER['REMOTE_ADDR'];
        $datatype=$_POST['datatype'];
        $dataid=$_POST['dataid'];
        $data=Db::table('blog_like')
            ->where('LikeType', $datatype)
            ->where('PostingID',$dataid)
            ->where("LikeIP",$clientip)
            ->find();
        if($data) {
            echo json_encode(0);
            exit;
        }else {
            $insertdata = array(
                "PostingID" => $dataid,
                "LikeIP" => $clientip,
                "LikeTime" => time(),
                "LikeType" => $datatype
            );
            Db::table('blog_like')->insert($insertdata);
            echo json_encode(1);
            exit;
        }
    }

    /**
     * 文章下一步加载
     */
    public function artnext()
    {
        $cpage = $_POST['cpage'];
        $typeid = $_POST['typeid'];
        $selkeywords = $_POST['keywords'];
        //获取最新的10条文章
        $articledata = Common::articlelst($typeid, $cpage, $selkeywords);
        $html = "";
        foreach ($articledata as $article) {
            $html .= '<article class="excerpt">
    <header>
        <a class="label label-yuanchuang" style="background-color:' . ($article['ArticleType'] ? "#777" : "#5cb85c") . '"  href="#">' . ($article['ArticleType'] ? "转载" : "原创") . '</a>
        ' . ($article['TypeName'] ? "<a class='label label-important' href='/blog/{$article['TypeID']}'>{$article['TypeName']}<i class='label-arrow'></i></a>" : "") . '
        <h2><a target="_blank" href="/blog/article/'.$article['ArticleID'].'" title="' . $article['ArticleTitle'] . '">' . $article['ArticleTitle'] . '</a></h2>
    </header>
    <div class="focus">
        <a target="_blank" href="#">
            <img class="thumb" style="width:200px;height:123px;margin-bottom:20px;" src="' . ($article['ArticleImg'] ? $article['ArticleImg'] : "http://liuxiaomo.cn/static/admin/uploadfiles/default.jpg") . '" alt="' . $article['ArticleTitle'] . '">
        </a>
    </div>
        <span class="note">' . ($article['ArticleMsg'] ? (mb_strlen(strip_tags($article['ArticleMsg']), 'UTF8') >= 300 ? mb_substr(strip_tags($article['ArticleMsg']), 0, 300) . "..." : strip_tags($article['ArticleMsg'])) : "") . '&nbsp;&nbsp;&nbsp; <a href="http://www.xuechenlei.com/2017/03/js-function-group/" rel="nofollow" class="more-link">继续阅读 »</a>
        </span>
    <br/><br/>
    <p class="auth-span">
        <span class="muted"><i class="icon-user"></i> <a href="#">刘小莫</a></span>
        <span class="muted"><i class="icon-time"></i> ' . $article['PublishTime']. '</span>
        <span class="muted"><i class="icon-eye-open"></i> ' . $article['ReadNum'] . '浏览</span>
        <span class="muted"><a href="javascript:;" onclick="likeoperation(1,{$article.ArticleID})" class="action"><i class="{$article.IsLike?"icon-heart":"icon-heart-empty"}" id="artlikenumi{$article.ArticleID}"></i><font id="artlikenum{$article.ArticleID}">' . $article['LikeNum'] . '</font>个赞</a></span></p>
</article>';
        }
        echo $html;
        exit;
    }

    /**
     * 查看文章详情
     */
    public function articleDetail($articleid=0)
    {
        //获取网站通用数据
        $blogcommdata = Common::blogcommdata();
        //获取喜欢网站的总人数
        $this->assign('weblikenum', $blogcommdata['weblikenum']);
        //获取文章总数
        $this->assign('articlenum', $blogcommdata['articlenum']);
        //获取留言总数
        $this->assign('postnum', $blogcommdata['postnum']);
        //获取分类目录以及目录下的文章数量
        $this->assign('typelst', $blogcommdata['typelst']);
        //用户总数
        $this->assign('usernum', $blogcommdata['usernum']);
        //最后更新时间
        $this->assign('lasttime', $blogcommdata['lasttime']);
        //网站发布时间
        $this->assign('publictime', $blogcommdata['publictime']);
        //获取最新的5条评论
        $this->assign('postdata', $blogcommdata['lastcomment']);
        //获取博客配置信息
        $blogdata = Common::blogconfig();
        $this->assign('blogdata', $blogdata);
        //获取文章信息
        $articledata = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->where('ArticleID', $articleid)
            ->find();
        //更新文章浏览量
        Common::readnumupdate($articledata['ArticleID'], 0);
        //当前IP是否点赞
        $islike = Common::isLike($articleid, 1);
        $articledata['IsLike'] = $islike;
        //当前文章点赞总数
        $likenum = Common::praisecount($articledata['ArticleID'], 0);
        $articledata['LikeNum'] = $likenum;
        $articledata['ArticleTag'] = $articledata['ArticleTag'] ? explode(",", $articledata['ArticleTag']) : "";
        //当前评论总数
        $comment = Common::praisecount($articledata['ArticleID'], 1);
        $articledata['CommentNum'] = $comment;
        $articledata['ReadNum'] = $articledata['ReadNum'] + 1;
        $articledata['PublishTime'] = date('Y-m-d H:i:s', $articledata['PublishTime']);
        //获取当前评论内容
        $commentlst = Common::commentlst($articledata['ArticleID'], 1);
        $articledata['commentlst'] = $commentlst;
        //获取当前文章的所属分类/展示当前位置
        $typename = Db::table('article_type')
            ->where('TypeID', $articledata['TypeID'])
            ->find();
        $location = ['pagekeywords' => implode(",", $articledata['ArticleTag']), 'pagedesc' => $articledata['ArticleTitle'], 'blogtitle' => $articledata['ArticleTitle'], 'onemsg' => $typename['TypeName'], 'oneurl' => '/blog/' . $typename['TypeID'], 'lastmsg' => $articledata['ArticleTitle']];
        $this->assign('nowlocation', $location);
        $this->assign('article', $articledata);
        $this->assign('nojs', 1);
        //获取前一篇以及后一篇文章
        $before = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->where('ArticleID', '<', $articleid)
            ->order('ArticleID DESC')
            ->limit(1)
            ->find();
        $after = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->where('ArticleID', '>', $articleid)
            ->order('ArticleID ASC')
            ->limit(1)
            ->find();
        $this->assign('bforeafter', ['before' => $before, 'after' => $after]);
        return $this->fetch('article');
    }

    /**
     * 增加文章分享次数
     * @param int $dataid
     */
    public function doShare()
    {
        $dataid = $_POST['dataid'];
        //更新文章分享次数
        Common::readnumupdate($dataid,1);
        echo json_decode(0);
        exit;
    }


    /**
     * 评论文章操作
     * @param int $dataid 文章ID
     * @param string $commentmsg 评论内容
     * @param string $nickname 评论用户的昵称
     * @param string $useremail 评论用户的邮箱
     * @param string $userurl 评论用户的网址
     */
    public function userComment()
    {
        $dataid = $_POST['dataid'];
        $commentmsg = $_POST['commentmsg'];
        $nickname = $_POST['username'];
        $useremail = $_POST['useremail'];
        $userurl = $_POST['userurl'];
        $userimg = $_POST['userimg'];
        //获取客户端IP
        $clienip = Common::GetIP();
        //获取客户端的城市信息
        $taobaoIP = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $clienip;
        $IPinfo = json_decode(file_get_contents($taobaoIP));
        $userpro = $IPinfo->data->region;
        $usercity = $IPinfo->data->city;
        //获得用户ID
        $userid = Common::adduser($nickname, $useremail, 0, $userimg, $userpro, $usercity, $userurl,"", 0);
        //保存评论信息
        Common::usercomment($dataid, $commentmsg, $userid, 0, $clienip);
        echo json_encode(0);
        exit;
    }
}
