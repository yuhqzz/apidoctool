<?php
/**
 * 后台数据管理相关操作
 * 作者：刘单风
 * 最后修改时间：2016-12-23
 * 版权：刘单风个人所有
 */
namespace app\admin\controller;
use app\common\model\Projects;
use think\Controller;
use think\Hook;
class Admin extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        Hook::listen('CheckAuth');
    }

    /**
     * 项目列表
     */
    public function Projectlists()
    {
        $projectsModel = new Projects();
        $projectdata = $projectsModel->projectlists();
        $this->assign('projects', $projectdata);
        return $this->fetch('projects');
    }

    /**
     * 添加/编辑项目
     * @param int $proid 项目id
     */
    public function addProject($proid = 0)
    {
        $projectsModel = new Projects();
        if ($proid) {
            $projectdata = $projectsModel->prodetails($proid);
        } else {
            $projectdata = $projectsModel->toArray();
        }
        $this->assign("project", $projectdata);
        return $this->fetch('addproject');
    }

    /**
     * 项目保存
     */
    public function doAddProject()
    {
        $projectsModel = new Projects();
        //查询项目是否存在
        $data = $projectsModel->proisexist($_POST['proid'], $_POST['projectname']);
        if ($data) {
            $this->error('该项目已经存在，请重新输入', '/admin/addproject');
        } else {
            $projectsModel->proinsert($_POST['proid'], $_POST['projectname'], $_POST['projectinfo']);
            $this->success('保存成功', '/admin/projects');
        }
    }

    /**
     * 删除项目
     * @param $typeid 项目id
     */
    public function delProject($proid)
    {
        $projectsModel = new Projects();
        $result = $projectsModel->deletepro($proid);
        if ($result) {
            $this->error('你没权限删除该项目,请联系管理员', '/admin/projects');
        } else {
            $this->success('删除成功', '/admin/projects');
        }
    }

    /**
     * 文章列表
     */
    public function Articles()
    {
        $data = Db::table('articles')
            ->where('IsLogicDel', 0)
            ->order('ArticleID DESC')
            ->paginate(10);
        $this->assign('articles', $data);
        return $this->fetch('articles');
    }

    /**
     * 文章添加/编辑
     * @param int $articleid文章ID
     */
    public function addarticle($articleid = 0)
    {
        $data = model('Articles')->toArray();
        if ($articleid) {
            $data = Db::table('articles')
                ->where('ArticleID', $articleid)
                ->where("IsLogicDel", 0)
                ->find();
        }
        //获取文章分类
        $typedata = Db::table('article_type')
            ->where('IsLogicDel', 0)
            ->select();
        $this->assign("article", $data);
        $this->assign("articletype", $typedata);
        return $this->fetch('addarticle');
    }

    /**
     * 文章封面图上传
     */
    public function fileupload()
    {
        //定义可以上传的文件类型
        $typelist = array("image/gif", "image/jpg", "image/jpeg", "image/png");
        $coverfile = $_FILES['coverfile'];
        if (is_uploaded_file($coverfile['tmp_name']) && in_array($coverfile['type'], $typelist)) {
            //获取文件扩展名
            $exten_name = pathinfo($coverfile['name'], PATHINFO_EXTENSION);
            $articleid = $_POST['articleid'];
            //重新命名图片名称
            $picname = $articleid . time() . "." . $exten_name;//重新命名文件名
            $fpath =ROOT_PATH."/public/static/admin/uploadfiles/" . date('Ymd') . "/";
            //路径是否存在，不存在则创建
            if (!is_dir($fpath)) mkdir($fpath, 0777);
            //调用move_uploaded_file（）函数，进行文件转移
            $path = $fpath . $picname;
            if (move_uploaded_file($coverfile['tmp_name'], $path)) {
                echo "<p style='color:red'>上传成功！</p>";
                $titleimgframe = "https://liuxiaomo.cn/static/admin/uploadfiles/" . date('Ymd') . "/" . $picname;
                echo "<script>window.parent.document.getElementById('coverimg').value='" . $titleimgframe . "';</script>";
            }
        }
        exit();
    }

    /**
     * 文章添加/编辑保存
     */
    public function doAddarticle()
    {
        //查询当前文章是否存在
        if($_POST['articleid']) {
            $isdata=Db::table('articles')
                ->where('ArticleTitle', $_POST['articletitle'])
                ->where("ArticleID!=".$_POST['articleid'])
                ->where("IsLogicDel",0)
                ->find();
        }else {
            $isdata = Db::table('articles')
                ->where('ArticleTitle', $_POST['articletitle'])
                ->where("IsLogicDel", 0)
                ->find();
        }
        if($isdata) {
            $this->error('该文章已经存在，请重新编辑', '/admin/addarticle'.$_POST['articleid']?$_POST['articleid']:"");
        }else {
            $data = [
                'ArticleTitle'  => $_POST['articletitle'],
                'TypeID'        => $_POST['typeid'],
                'EditTime'      => time(),
                'IsPublish'     => 1,
                'ArticleType'   => $_POST['articletype'],
                'ArticleMsg'    => $_POST['articlemsg'],
                'ArticleDigest' => $_POST['articedigest'],
                'ArticleTag'    => $_POST['articetag'],
                'ArticleImg'    =>$_POST['coverimg']
            ];
            if ($_POST['articleid']) {
                Db::table('articles')->where('ArticleID=' . $_POST['articleid'])->update($data);
            } else {
                $data['PublishTime']=time();
                $data['CreateTime']=time();
                Db::table('articles')->insert($data);
            }
            $this->success('保存成功', '/admin/articles');
        }
    }

    /**
     * ajax文章数据保存
     */
    public function doAjaxarticle()
    {
        //查询当前文章是否存在
        if($_POST['articleid']) {
            $data=Db::table('articles')
                ->where('ArticleTitle', $_POST['articletitle'])
                ->where("ArticleID!=".$_POST['articleid'])
                ->where("IsLogicDel",0)
                ->find();
        }else {
            $data = Db::table('articles')
                ->where('ArticleTitle', $_POST['articletitle'])
                ->where("IsLogicDel", 0)
                ->find();
        }
        if($data) {
            echo json_encode(0);
            exit;
        }else {
            $data = [
                'ArticleTitle'  => $_POST['articletitle'],
                'TypeID'        => $_POST['typeid'],
                'EditTime'      => time(),
                'IsPublish'     => 0,
                'ArticleType'   => $_POST['articletype'],
                'ArticleMsg'    => $_POST['articlemsg'],
                'ArticleDigest' => $_POST['articedigest'],
                'ArticleTag'    => $_POST['articetag']
            ];
            if ($_POST['articleid']) {
                Db::table('articles')->where('ArticleID=' . $_POST['articleid'])->update($data);
                $dataid=$_POST['articleid'];
            } else {
                $data['CreateTime']=time();
                Db::table('articles')->insert($data);
                $dataid = Db::name('articles')->getLastInsID();
            }
            echo json_encode($dataid);
            exit;
        }
    }

    /**
     * 文章删除
     * @param $articleid
     */
    public function delArticle($articleid)
    {
        $data = ['IsLogicDel' => 1];
        Db::table('articles')->where('ArticleID=' . $articleid)->update($data);
        $this->success('删除成功', '/admin/articles');
    }

    /**
     * 文章回收站列表
     */
    public function artRecycle()
    {
        $data = Db::table('articles')
            ->where('IsLogicDel', 1)
            ->paginate(10);
        $this->assign('articles', $data);
        return $this->fetch('artrecycle');
    }

    /**
     * 回收站文章删除
     * @param $articleid 文章ID
     */
    public function delRecycle($articleid)
    {
        Db::table('articles')
            ->where('IsLogicDel',1)
            ->where('ArticleID',$articleid)
            ->delete();
        $this->success('删除成功', '/admin/artrecycle');
    }

    /**
     * 闲言碎语列表
     */
    public function Gossips()
    {
        $data = Db::table('blog_gossip')
            ->order('ID DESC')
            ->paginate(10);
        $this->assign('gossips', $data);
        return $this->fetch('gossips');
    }

    /**
     * 删除碎语信息
     * @param $gossipid 碎语id
     */
    public function delGossip($gossipid,$statusid=0)
    {
        if ($statusid) {
            Db::table('blog_gossip')
                ->where('ID', $gossipid)
                ->delete();
        } else {
            $data = ['IsLogicDel' => 1];
            Db::table('blog_gossip')->where('ID=' . $gossipid)->update($data);
        }
        $this->success('删除成功', '/admin/gossips');
    }

    /**
     * 编辑/添加碎语信息
     * @param $gossipid 碎语id
     */
    public function editGossip($gossipid=0)
    {
        $data = model('Gossips')->toArray();
        if ($gossipid) {
            $data = Db::table('blog_gossip')
                ->where('ID', $gossipid)
                ->find();
        }

        $this->assign("gossip", $data);
        return $this->fetch('addgossip');
    }

    /**
     * 碎语添加/编辑保存
     */
    public function doAddGossip()
    {
        //查询当前碎语是否存在
        if ($_POST['gossipid']) {
            $isdata = Db::table('blog_gossip')
                ->where('DataMsg', $_POST['datamsg'])
                ->where("ID!=" . $_POST['gossipid'])
                ->where("IsLogicDel", 0)
                ->find();
        } else {
            $isdata = Db::table('blog_gossip')
                ->where('DataMsg', $_POST['datamsg'])
                ->where("IsLogicDel", 0)
                ->find();
        }
        if ($isdata) {
            $this->error('该碎语已经存在，请重新编辑', '/admin/addgossip' . $_POST['gossipid'] ? $_POST['gossipid'] : "");
        } else {
            $data = [
                'DataMsg' => $_POST['datamsg'],
                'IsLogicDel' => $_POST['datatatus'],
                'DataTime' => time()
            ];
            if ($_POST['gossipid']) {
                Db::table('blog_gossip')->where('ID=' . $_POST['gossipid'])->update($data);
            } else {
                Db::table('blog_gossip')->insert($data);
            }
            $this->success('保存成功', '/admin/gossips');
        }
    }

}
