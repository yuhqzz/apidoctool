<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Common;

class Index extends Controller
{
    /**
     * 网站首页
     */
    public function index()
    {
        // 临时关闭当前模板的布局功能
        $this->view->engine->layout(false);
        return $this->fetch('index');
    }

    /**
     * 自我介绍页面
     */
    public function aboutMe()
    {
        //当前位置
        $location = ['onemsg' => '', 'lastmsg' => '关于我', 'pagekeywords' => '刘小莫,自我介绍', 'pagedesc' => 'about me', 'blogtitle' => '刘小莫自我介绍|结交同道中人!'];
        $this->assign('nowlocation', $location);
        $this->view->engine->layout('layouts/twoindex');
        //获取博客配置信息
        $blogdata = Common::blogconfig();
        $this->assign('blogdata', $blogdata);
        return $this->fetch('aboutme');
    }


    /**
     * 留言板信息
     */
    public function blogWords()
    {
        //当前位置
        $location = ['onemsg' => '', 'lastmsg' => '留言板', 'pagekeywords' => '刘小莫,留言板', 'pagedesc' => 'PHP技术相关,留言板信息交流', 'blogtitle' => '刘小莫留言板|欢迎拍砖畅所欲言!'];
        $this->assign('nowlocation', $location);
        $this->view->engine->layout('layouts/twoindex');
        //获取博客配置信息
        $blogdata = Common::blogconfig();
        $this->assign('blogdata', $blogdata);
        //获取留言板信息总数
        $commentcount = Common::praisecount(0, 1);
        $this->assign('wordscount', $commentcount);
        //获取留言板信息
        $commentlst = Common::commentlst(0, 1);
        $this->assign('wordlst', $commentlst);
        return $this->fetch('blogwords');
    }

    /**
     * 留言板下一页数据加载
     */
    public function blogWordsnext()
    {
        $cpage = $_POST['cpage'];
        $articleid = $_POST['articleid'] ? $_POST['articleid'] : 0;
        //获取留言板信息
        $commentlst = Common::commentlst($articleid, $cpage);
        $html = "";
        foreach ($commentlst as $comm) {
            $html .= '<li class="commentlst">
                <div class="c-avatar">
                    <img class="avatar" height="54" width="54" src="' . ($comm['ImgUrl'] ? $comm['ImgUrl'] : "/homeback/35.jpg") . '" style="display: block;">
                    <div class="c-main">' . $comm['PostContent'] . '
                        <div class="c-meta">
                        <span class="c-author">
                            <a href="' . ($comm['UserUrl'] ? $comm['UserUrl'] : "http://liuxiaomo.cn") . '" class="url" target="_blank">' . ($comm['PostName'] ? $comm['PostName'] : "匿名用户") . '</a>
                        </span>
                            ' . date("Y-m-d H:i:s", $comm['PostDate']) . '
                        </div>
                    </div>
                </div>';
            if ($comm['commchild']) {
                $html .= '<ul class="children">';
                foreach ($comm['commchild'] as $childpost) {
                    $html .= '<li class="commentlst">
                        <div class="c-avatar">
                            <img class="avatar" height="54" width="54" src="' . ($childpost['ImgUrl'] ? $childpost['ImgUrl'] : "/homeback/35.jpg") . '" style="display: block;">
                            <div class="c-main" id="div-comment-65">
                                ' . $childpost['PostContent'] . '
                                <div class="c-meta">
                                <span class="c-author">
                                    <a href="' . ($childpost['UserUrl'] ? $childpost['UserUrl'] : "http://liuxiaomo.cn") . '" class="url" target="_blank">' . ($childpost['PostName'] ? $childpost['PostName'] : "匿名用户") . '</a>
                                </span >
                                    <a title = "博主认证" class="vip" ></a >
                                    ' . date("Y-m-d H:i:s", $childpost['PostDate']) . ' 
                                </div >
                            </div >
                        </div >
                    </li >';
                }
                $html .= '</ul >';
            }
            $html .= ' </li>';
        }
        echo $html;
        exit;
    }

    /**
     * 闲言碎语页面
     */
    public function gossips()
    {
        //当前位置
        $location = ['onemsg' => '', 'lastmsg' => '我有话说', 'pagekeywords' => '刘小莫,闲言碎语', 'pagedesc' => 'my gossip', 'blogtitle' => '刘小莫的胡言乱语'];
        $this->assign('nowlocation', $location);
        $this->view->engine->layout('layouts/twoindex');
        //获取博客配置信息
        $blogdata = Common::blogconfig();
        $this->assign('blogdata', $blogdata);
        //获取碎语列表信息
        $data=Common::gossiplst(1);
        $this->assign('gossips', $data);
        return $this->fetch('gossips');
    }

    public function gossipsnext()
    {
        $cpage = $_POST['cpage'];
        //获取碎语列表信息
        $data = Common::gossiplst($cpage);
        $html = "";
        foreach ($data as $item) {
            $html .= '<li>
                    <span class="tt">' . date("Y年m月d H:i", $item['DataTime']) . '</span>
                    <div class="shuoshuo-content">
                        <p style="font-size:14px;line-height:0px;">' . $item['DataMsg'] . '</p>
                    </div>
                </li>';
        }
        echo $html;
        exit;
    }
}
