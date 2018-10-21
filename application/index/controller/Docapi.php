<?php
namespace app\index\controller;
use app\common\model\Projects;
use think\Controller;
use think\Hook;
class Docapi extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        Hook::listen('WebCheckAuth');
    }
    /**
     * 用户登录主页
     */
    public function userDefault()
    {
        $this->assign("menuselect", 1);
        //获取当前登录用户创建的项目
        $projectModel = new Projects();
        $returndata = $projectModel->myprojects();
        $this->assign("createdata", $returndata['createdata']);
        //当前登录用户加入的项目
        $this->assign("joindta", $returndata['joindata']);
        //获取用户参与项目内接口更新变化
        $indexupdate = $projectModel->indexupdate();
        $this->assign("indexupdate", $indexupdate);
        return $this->fetch('index');
    }

    /**
     * 项目列表
     */
    public function userProject()
    {
        $this->assign("menuselect", 2);
        $projectModel = new Projects();
        $projects = $projectModel->projectlists(1);
        $this->assign("projects", $projects);
        return $this->fetch('projects');
    }

    /**
     * 接口列表
     * @return mixed
     */
    public function userApis($proid=0,$moduleid=0){
        $this->assign("menuselect", 3);
        $projectModel = new Projects();
        $resultdata = $projectModel->webapilists($proid,$moduleid);
        //页面下拉项目列表
        $this->assign("projects", $resultdata['projects']);
        //当前项目下的版块列表
        $this->assign("modules", $resultdata['modules']);
        //当前项目id
        $this->assign("proid", $resultdata['proid']);
        //当前版块id
        $this->assign("moduleid", $resultdata['moduleid']);
        //当前项目名称
        $this->assign("proname", $resultdata['proname']);
        return $this->fetch('apis');
    }
}
