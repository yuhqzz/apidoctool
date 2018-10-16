<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Common extends Model
{
    /**
     * 获得博客信息
     */
   public static function blogconfig()
   {
       //获取博客配置信息
       $blogdata = Db::table('blog_config')
           ->find();
       return $blogdata;
   }

    /**
     * 博客通用数据
     */
    public static function blogcommdata()
    {
        //网站喜欢总人数
        $weblikenum = Db::table('blog_like')
            ->where('LikeType', 0)
            ->where('PostingID', 0)
            ->count('LikeID');
        //文章总数
        $articlenum = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->count();
        //留言总数
        $postnum = Db::table('blog_discuss')
            ->where('IsLogicDel', 0)
            ->count();
        //获取分类目录以及目录下的文章数量
        $typelst = Db::table('article_type')
            ->where('IsLogicDel', 0)
            ->where('IsHidden', 0)
            ->select();
        for ($i = 0; $i < count($typelst); $i++) {
            $typeartnum = Db::table('articles')
                ->where('IsLogicDel', 0)
                ->where('TypeID', $typelst[$i]['TypeID'])
                ->count();
            $typelst[$i]['ArticleNum'] = $typeartnum;
        }
        //获取最新的5条评论
        $comment = Db::table('blog_discuss')
            ->where('IsLogicDel', 0)
            ->order('PostDate DESC')
            ->limit(5)
            ->select();
        for ($i = 0; $i < count($comment); $i++) {
            $usermsg = Db::table('blog_users')
                ->where('UserID', $comment[$i]['UserID'])
                ->find();
            $comment[$i]['PostName'] = "";
            $comment[$i]['ImgUrl'] = "";
            if ($usermsg) {
                $comment[$i]['PostName'] = $usermsg['UserName'];
                $comment[$i]['ImgUrl'] = $usermsg['UserImg'];
            }
        }
        //用户总数
        $usercount = Db::table('blog_users')
            ->count();
        //最后更新时间
        $lasttime = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->order('ArticleID DESC')
            ->find();
        //网站上线天数
        $d1 = time();
        $d2 = 1485878400;
        $Days = round(($d1 - $d2) / 3600 / 24);
        $result = array(
            'weblikenum' => $weblikenum,
            'articlenum' => $articlenum,
            'postnum' => $postnum,
            'typelst' => $typelst,
            'lastcomment' => $comment,
            'usernum' => $usercount,
            'lasttime' => $lasttime['PublishTime'],
            'publictime' => $Days
        );
        return $result;
    }

    /**
     * 是否喜欢
     * @param int $dataid  数据id
     * @param int $datatype 数据类型；0喜欢网站；1文章；2评论;3文章收藏
     * @param int $userid 用户ID，微信账号使用
     * @param int $datasource 点赞来源，0网站；1微信小程序
     * @return int 1已喜欢；0未喜欢
     */
    public static function isLike($dataid=0,$datatype=0,$datasource=0,$userid=0)
    {
        $clientip = $_SERVER['REMOTE_ADDR'];
        $islike = Db::table('blog_like')
            ->where('LikeType', $datatype)
            ->where($datasource ? 'UserID' : 'LikeIP', $datasource ? $userid : $clientip)
            ->where('PostingID', $dataid)
            ->find();
        return $islike ? 1 : 0;
    }

    /**
     * 文章列表数据
     * @param int $typeid 文章分类id
     * @param int $cpage 请求页码
     * @param string $keywords 搜索关键词
     * @param int $istag 0搜索关键词；1按照标签搜索
     * @return array 数据集合
     */
    public static function articlelst($typeid=0,$cpage=1,$keywords="")
    {
        $articlewhere = [
            'IsLogicDel' => 0,
            'IsPublish' => 1
        ];
        if ($typeid) {
            $articlewhere['TypeID'] = $typeid;
        }
        if($keywords) {
            $articlewhere['ArticleTitle|ArticleMsg|ArticleTag'] = ['like', '%' . $keywords . '%'];
        }
        $articledata = Db::table('articles')
            ->where($articlewhere)
            ->order('PublishTime DESC')
            ->limit(10)
            ->page($cpage)
            ->select();
        for ($i = 0; $i < count($articledata); $i++) {
            $articledata[$i]['ArticleImg']=$articledata[$i]['ArticleImg']?$articledata[$i]['ArticleImg']:"https://liuxiaomo.cn/static/admin/uploadfiles/default.jpg";
            //更改发布时间
            $articledata[$i]['PublishTime']=self::mdate($articledata[$i]['PublishTime']);
            if (!$typeid||$keywords) {
                //获得文章分类信息
                $artictype = Db::table('article_type')
                    ->where('TypeID', $articledata[$i]['TypeID'])
                    ->find();
                $articledata[$i]['TypeName'] = $artictype['TypeName'];
            } else {
                $articledata[$i]['TypeName'] = '';
            }

            $likedata = Db::table('blog_like')
                ->where('LikeType', 1)
                ->where('PostingID', $articledata[$i]['ArticleID'])
                ->count();
            $articledata[$i]['LikeNum'] = $likedata;
            //当前IP是否点赞
            $islike = Common::isLike($articledata[$i]['ArticleID'], 1);
            $articledata[$i]['IsLike'] = $islike;
        }
        return $articledata;
    }


    /**
     * 文章列表数据接口
     * @param int $userid 用户ID
     * @param int $cpage 请求页码
     * @param int $datatype 最新数据列表;1置顶文章
     * @param int $typeid 分类id
     * @return array 数据集合
     */
    public static function apiartlst($cpage=1,$userid=0,$datatype=0,$typeid=0)
    {
        if (empty($datatype)) {
            $articlewhere = [
                'IsLogicDel' => 0,
                'IsPublish' => 1
            ];
            if ($typeid) {
                $articlewhere['TypeID'] = $typeid;
            }
            $articledata = Db::table('articles')
                ->where($articlewhere)
                ->order('PublishTime DESC')
                ->limit(10)
                ->page($cpage)
                ->select();
        } else {
            $articlewhere = [
                'IsLogicDel' => 0,
                'IsPublish' => 1,
                'IsTop' => 1
            ];
            $articledata = Db::table('articles')
                ->where($articlewhere)
                ->order('rand()')
                ->limit(3)
                ->select();
        }


        for ($i = 0; $i < count($articledata); $i++) {
            $articledata[$i]['ArticleDigest'] = $articledata[$i]['ArticleMsg'] ? (mb_strlen(strip_tags($articledata[$i]['ArticleMsg']), 'UTF8') >= 50 ? mb_substr(strip_tags($articledata[$i]['ArticleMsg']), 0, 50) . '。。。' : strip_tags($articledata[$i]['ArticleMsg'])) : '';
            $articledata[$i]['ArticleImg'] = $articledata[$i]['ArticleImg'] ? $articledata[$i]['ArticleImg'] : "https://liuxiaomo.cn/static/admin/uploadfiles/default.jpg";
            //更改发布时间
            $articledata[$i]['PublishTime'] = date("Y-m-d");
            //获得文章分类信息
            $artictype = Db::table('article_type')
                ->where('TypeID', $articledata[$i]['TypeID'])
                ->find();
            $articledata[$i]['TypeName'] = $artictype['TypeName'];

            $likedata = Db::table('blog_like')
                ->where('LikeType', 1)
                ->where('PostingID', $articledata[$i]['ArticleID'])
                ->count();
            $articledata[$i]['LikeNum'] = $likedata;
            //当前用户是否点赞
            $islike = Common::isLike($articledata[$i]['ArticleID'], 1, 1, $userid);
            $articledata[$i]['IsLike'] = $islike;
            //当前用户是否收藏
            $iscollect = Common::isLike($articledata[$i]['ArticleID'], 3, 1, $userid);
            $articledata[$i]['IsCollect'] = $iscollect;
        }
        return $articledata;
    }

    public static function mdate($time = NULL)
    {
        $text = '';
        $t = time() - $time; //时间差 （秒）
        $y = date('Y', $time) - date('Y', time());//是否跨年
        switch ($t) {
            case $t == 0:
                $text = '刚刚';
                break;
            case $t < 60:
                $text = $t . '秒前'; // 一分钟内
                break;
            case $t < 60 * 60:
                $text = floor($t / 60) . '分钟前'; //一小时内
                break;
            case $t < 60 * 60 * 24:
                $text = floor($t / (60 * 60)) . '小时前' ; // 一天内
                break;
            case $t < 60 * 60 * 24 * 3:
                $text = floor($time / (60 * 60 * 24)) == 1 ? '昨天' . date('H:i', $time) : '前天 ' . date('H:i', $time); //昨天和前天
                break;
            case $t < 60 * 60 * 24 * 30:
                $text = floor($t / (60 * 60 * 24)) . '天前';
                break;
            case $t < 60 * 60 * 24 * 365 && $y == 0:
                $text = floor($t / (60 * 60 * 24 * 30)) . '个月前';
                break;
            default:
                $text = date('Y-m-d', $time); //两年以前
                break;
        }
        return $text;
    }


    /**
     * 添加用户
     * @param $username 用户名
     * @param $usermail 邮箱
     * @param $usergender 用户性别0未知;1男;2女
     * @param $userimg 用户头像
     * @param $userpro 用户所在省
     * @param $usercity 用户所在城市
     * @param $userurl 用户网址
     * @param $openid 微信opeid
     * @param $usersource 用户来源0网站;1微信
     */
    public static function adduser($username,$usermail,$usergender,$userimg,$userpro,$usercity,$userurl,$openid,$usersource)
    {
        $userid = 0;
        //查询用户是否已经存在了
        $where['UserName'] = $username;
        if ($usermail) {
            $where['UserMail'] = $usermail;
        }
        if ($openid) {
            $where['OpenID'] = $openid;
        }
        $bolguser = Db::table('blog_users')
            ->where($where)
            ->find();
        if ($bolguser) {
            //该用户已经在了,返回用户ID
            $userid = $bolguser['UserID'];
        } else {
            //新增用户
            $uerarr = array(
                'UserName' => $username,
                'UserMail' => $usermail,
                'UserImg' => $userimg,
                'UserSource' => $usersource,
                'UserTime' => time(),
                'UserUrl' => $userurl,
                'UserGender' => empty($usergender) ? 0 : $usergender,
                'UserProvince' => $userpro,
                'UserCity' => $usercity,
                'OpenID' => $openid
            );
            Db::table('blog_users')->insert($uerarr);
            $userid = Db::name('blog_users')->getLastInsID();
        }
        return $userid;
    }

    /**
     * 获取客户端IP
     * @return string  IP地址
     */
    public static function GetIP()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        } else {
            $cip = "无法获取！";
        }
        return $cip;
    }

    /**
     * 用户评论文章
     * @param $dataid 文章ID;0是对网站的留言
     * @param $commentmsg 评论内容
     * @param $userid 用户ID
     * @param $fatherid 父节点ID,可能是评论的评论
     */
    public static function usercomment($dataid,$commentmsg,$userid,$fatherid,$clienip)
    {
        $userid = empty($userid) ? -1 : $userid;
        //查询是否已经评论过相同内容
        $discuss = Db::table('blog_discuss')
            ->where('PostContent', $commentmsg)
            ->where('ArticleID', $dataid)
            ->where('IsLogicDel', 0)
            ->where('FatherID', $fatherid)
            ->where('UserID', $userid)
            ->find();

        if (!$discuss) {
            //保存评论信息
            $discussarr = array(
                "PostContent" => $commentmsg,
                "PostDate" => time(),
                "IsLogicDel" => 0,
                "FatherID" => $fatherid,
                "UserID" => $userid == -1 ? 0 : $userid,
                "PostIP" => $clienip,
                "ArticleID" => $dataid
            );
            Db::table('blog_discuss')->insert($discussarr);
        }
    }

    /**
     * 更新文章阅读量/分享次数
     * @param $articleid 文章ID
     * @param $datatype 0文章阅读量、1文章分享次数
     */
    public static function readnumupdate($articleid,$datatype=0)
    {
        Db::table('articles')
            ->where('ArticleID', $articleid)
            ->setInc($datatype==0?'ReadNum':'ShareNum');
    }


    /**
     * 点赞总数、评论总数
     * @param $articleid 文章id
     * @param int $datatype 0点赞总数;1评论总数
     */
    public static function praisecount($articleid,$datatype=0)
    {
        if ($datatype == 0) {
            $dataresult = Db::table('blog_like')
                ->where('LikeType', 1)
                ->where('PostingID', $articleid)
                ->count();

        } else {
            $dataresult = Db::table('blog_discuss')
                ->where('IsLogicDel', 0)
                ->where('FatherID', 0)
                ->where('ArticleID', $articleid)
                ->count();
        }
        return $dataresult;

    }

    /**
     * 获取文章/网站的评论列表
     * @param $articleid 文章ID,0则是网站的评论列表
     * @param $cpage 请求页码
     */
    public static function commentlst($articleid,$cpage,$userid=0)
    {
        $where = [
            'ArticleID' => $articleid,
            'IsLogicDel' => 0,
            'FatherID' => 0,
        ];
        $where['IsLogicDel'] = 0;
        if ($userid) {
            $where['UserID'] = $userid;
        }
        $articledata = Db::table('blog_discuss')
            ->where($where)
            ->order('PostingID DESC')
            ->limit(10)
            ->page($cpage)
            ->select();
        for ($i = 0; $i < count($articledata); $i++) {
            $articledata[$i]['PostDate2']=self::mdate($articledata[$i]['PostDate']);
            //获取该评论下的子节点
            $articledata[$i]['commchild']=null;
            //获取用户信息
            $usermsg = Db::table('blog_users')
                ->where('UserID', $articledata[$i]['UserID'])
                ->find();
            $articledata[$i]['PostName'] = "";
            $articledata[$i]['ImgUrl'] = "";
            if ($usermsg) {
                $articledata[$i]['PostName'] = $usermsg['UserName'];
                $articledata[$i]['ImgUrl'] = $usermsg['UserImg'];
            }
        }
        return $articledata;
    }

    /**
     * 闲言碎语列表信息
     */
    public static function gossiplst($cpage=1)
    {
        //获取碎语列表信息
        $data = Db::table('blog_gossip')
            ->where('IsLogicDel', 0)
            ->order('ID DESC')
            ->limit(10)
            ->page($cpage)
            ->select();
        return $data;
    }
}
