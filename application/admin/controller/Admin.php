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
     * 接口版块列表
     * @param $typeid 项目id
     */
    public function Apimodules($proid)
    {
        $projectsModel = new Projects();
        $modules = $projectsModel->promodules($proid);
        $this->assign("modules", $modules);
        $this->assign("proid", $proid);
        return $this->fetch('modules');
    }

    /**
     * 添加接口版块
     * @param $moduleid
     */
    public function addModule($proid,$moduleid=0)
    {
        $projectsModel = new Projects();
        if ($moduleid) {
            $moduledata = $projectsModel->moduledetails($moduleid);
        } else {
            $moduledata = $projectsModel->toArray();
        }
        $this->assign("module", $moduledata);
        $this->assign("proid", $proid);
        return $this->fetch('addmodule');
    }

    /**
     * 添加版块保存
     */
    public function doAddmodule()
    {
        $projectsModel = new Projects();
        //查询项目是否存在
        $data = $projectsModel->moduleisexist($_POST['proid'], $_POST['modulename'], $_POST['moduleid']);
        if ($data) {
            $this->error('该接口版块已经存在，请重新输入', '/admin/addModule/' . $_POST['proid']);
        } else {
            $projectsModel->moduleinsert($_POST['proid'], $_POST['modulename'], $_POST['moduleid']);
            $this->success('保存成功', '/admin/modules/' . $_POST['proid']);
        }
    }

    /**
     * 删除版块
     * @param $moduleid
     */
    public function delModule($proid,$moduleid)
    {
        $projectsModel = new Projects();
        $result = $projectsModel->deletemodule($proid, $moduleid);
        if ($result) {
            $this->error('你没权限删除该版块,请联系管理员', '/admin/modules/' . $proid);
        } else {
            $this->success('删除成功', '/admin/modules/' . $proid);
        }
    }

}
