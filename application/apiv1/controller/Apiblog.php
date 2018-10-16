<?php
/**
 * 小程序接口
 * 作者：刘单风
 * 最后修改时间：2018-02-04
 * 版权：刘单风
 */
namespace app\apiv1\controller;
use app\common\model\Common;
use think\Db;
class Apiblog
{
    /**
     * 列表接口
     * @param int $userid  用户ID
     * @param int $typeid  文章类型ID
     * @param int $cpage  请求页码
     * @return \think\response\Json
     */
    public function index()
    {
        $userid = $_REQUEST['userid'];//用户ID
//        if ($username && $username != "undefined"&&empty($userid)) {
//            //添加用户
//            $userid = Common::adduser($username, "", $usergender, $userimg, $userpro, $usercity, "","", 1);
//        } else {
//            $userid = 0;
//        }
        $cpage = $_REQUEST['cpage'] ? $_REQUEST['cpage'] : 1;
        $typeid = $_REQUEST['typeid'];
        if ($cpage == 1&&empty($typeid)) {
            //第一页返回分类列表数据
            //获取分类数据
            $typelst = Db::table('article_type')
                ->where('IsLogicDel', 0)
                ->where('IsHidden', 0)
                ->select();
            //获取三条banner文章
            $bannerdata = Common::apiartlst($cpage, $userid, 1);
            //最新的10篇文章
            $articledata = Common::apiartlst($cpage, $userid);
            //获取每日分享数据
            $dateshare = Db::table('blog_gossip')
                ->where('IsLogicDel', 0)
                ->order('ID DESC')
                ->limit(5)
                ->select();
        } else {
            if($typeid){
                //返回文章类型列表数据
                $typelst = Db::table('article_type')
                    ->where('IsLogicDel', 0)
                    ->where('IsHidden', 0)
                    ->select();
            }
            //获取最新的10条文章
            $articledata = Common::apiartlst($cpage, $userid,0,$typeid);
        }
        return json(['art' => $articledata, 'cpage' => $cpage + 1, 'typelst' => $typelst, 'dateshare' => $dateshare, 'bannerdata' => $bannerdata]);
    }

    /**
     * 获取文章详情
     * @param int $artid  文章ID
     * @param int $userid  用户ID
     * @return \think\response\Json
     */
    public function artdetail()
    {
        $artid = $_REQUEST['artid'];
        $userid = $_REQUEST['userid'];//用户ID
        //获取文章信息
        $articledata = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->where('ArticleID', $artid)
            ->find();
        //更新文章浏览量
        Common::readnumupdate($articledata['ArticleID'], 0);
        //当前微信用户是否点赞
        $islike = Common::isLike($artid, 1, 1, $userid);
        $articledata['IsLike'] = $islike;
        //当前微信用户是否收藏
        $iscollect = Common::isLike($artid, 3, 1, $userid);
        $articledata['IsCollect'] = $iscollect;
        //获得文章分类信息
        $artictype = Db::table('article_type')
            ->where('TypeID', $articledata['TypeID'])
            ->find();
        $articledata['TypeName'] = $artictype['TypeName'];
        //当前文章点赞总数
        $likenum = Common::praisecount($articledata['ArticleID'], 0);
        $articledata['LikeNum'] = $likenum;
        $articledata['ArticleTag'] = $articledata['ArticleTag'] ? explode(",", $articledata['ArticleTag']) : "";
        $articledata['ReadNum'] = $articledata['ReadNum'] + 1;
        $articledata['PublishTime'] = date('Y-m-d H:i:s', $articledata['PublishTime']);

        //获取当前文章的前10条评论
        $commentlst = Common::commentlst($articledata['ArticleID'], 1);
        $articledata['commentlst'] = $commentlst;

        return json(['artdetail' => $articledata]);
    }

    /**
     * 给文章点赞/收藏文章
     * @param int $artid  文章ID
     * @param int $opertype  0文章点赞;1文章收藏
     * @param int $userid  用户ID
     * @return \think\response\Json
     */
    public function artlike()
    {
        $artid = $_REQUEST['artid'];
        $opertype = $_REQUEST['opertype'];
        $userid = $_REQUEST['userid'];//用户id

        $clientip = $_SERVER['REMOTE_ADDR'];
        $data = Db::table('blog_like')
            ->where('LikeType', empty($opertype) ? 1 : 3)
            ->where('PostingID', $artid)
            ->where("UserID", $userid)
            ->find();
        if ($data) {
            //已经点过赞了
            $result = 0;
        } else {
            $insertdata = array(
                "PostingID" => $artid,
                "LikeIP" => $clientip,
                "LikeTime" => time(),
                "LikeType" => empty($opertype) ? 1 : 3,
                "UserID" => $userid
            );
            Db::table('blog_like')->insert($insertdata);
            $result = 1;
            $likenum = Db::table('blog_like')
                ->where('LikeType', empty($opertype) ? 1 : 3)
                ->where('PostingID', $artid)
                ->count();
        }
        return json(['status' => $result, "num" => $likenum, "artid" => $artid]);
    }

    /**
     * 微信端评论文章
     * @param int $artid  文章ID
     * @param string $commentmsg  评论内容
     * @param int $userid  用户ID
     */
    public function artcomment()
    {
        $artid = $_REQUEST['artid'];
        $commentmsg = $_REQUEST['commentmsg'];
        $userid = $_REQUEST['userid'];
        //获取客户端IP
        $clienip = Common::GetIP();
        //保存评论信息
        Common::usercomment($artid, $commentmsg, $userid, 0, $clienip);
        //获取我的评论
        $commlst = Common::commentlst($artid, 1, $userid);
        return json(['status' => 1, "mycomment" => $commlst]);
    }

    public function wechatlogin()
    {
        $username = $_REQUEST['username'];//微信昵称
        $userimg = $_REQUEST['userimg'];//微信头像
        $usergender = $_REQUEST['usergender'];//微信性别
        $userpro = $_REQUEST['userpro'];//微信所在省
        $usercity = $_REQUEST['usercity'];//微信所在市
        $code = $_REQUEST['code'];//微信code数据

        //获取openid
        $formAction = "https://api.weixin.qq.com/sns/jscode2session?appid=wx9149257d3684bb49&secret=2d4a1f4eb882a7bb52fa18f663462650&js_code=$code&grant_type=authorization_code";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $formAction);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 0);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, true);
        $openid = $res['openid'];
        //添加用户
        $userid = Common::adduser($username, "", $usergender, $userimg, $userpro, $usercity, "", $openid, 1);
        return json(['status' => 0, 'userdata' => ['userid' => $userid, 'nickName' => $username, 'avatarUrl' => $userimg, 'gender' => $usergender, 'province' => $userpro, 'city' => $usercity]]);
    }

    public function urlreturn()
    {
        return json(['url' => 'http://baidu.com']);
    }
}