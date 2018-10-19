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
    public function userDefault(){
        $this->assign("menuselect", 1);
        //获取当前登录用户创建的项目
        $projectModel=new Projects();
        $returndata=$projectModel->myprojects();
        $this->assign("createdata", $returndata['createdata']);
        //当前登录用户加入的项目
        $this->assign("joindta", $returndata['joindata']);
        //获取用户参与项目内接口更新变化
        $indexupdate=$projectModel->indexupdate();
        $this->assign("indexupdate", $indexupdate);
        return $this->fetch('index');
    }

}
