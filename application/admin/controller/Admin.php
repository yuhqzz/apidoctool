<?php
/**
 * 后台数据管理相关操作
 * 作者：刘单风
 * 最后修改时间：2016-12-23
 * 版权：刘单风个人所有
 */
namespace app\admin\controller;
use app\common\model\Projects;
use app\common\model\Users;
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

    /**
     * 接口列表
     * @param $moduleid
     */
    public function Docapis($proid=0,$moduleid=0)
    {
        $projectsModel = new Projects();
        $docapis = $projectsModel->docapis($proid, $moduleid);
        $this->assign("docapis", $docapis);
        $this->assign("moduleid", $moduleid);
        $this->assign("proid", $proid);
        return $this->fetch('docapis');
    }

    /**
     * 添加、编辑接口
     * @param $apiid
     */
    public function addDocapi($proid,$moduleid,$apiid=0){
        $projectsModel = new Projects();
        if ($apiid) {
            $apidata = $projectsModel->apidetails($apiid);
            $proid=$apidata['apiid'];
            $moduleid=$apidata['moduleid'];
        } else {
            $apidata = $projectsModel->toArray();
        }
        //获取项目列表
        $prolists=$projectsModel->projectlists();
        if($proid){
            //获取项目下的版块列表
            $modules=$projectsModel->promodules($proid);
        }
        $this->assign("docapi", $apidata);
        $this->assign("prolists", $prolists);
        $this->assign("modules", $modules);
        $this->assign("proid", $proid);
        $this->assign("moduleid", $moduleid);
        $this->assign("apiid", $apiid);
        return $this->fetch('adddocapi');
    }

    /**
     * 接口保存
     */
    public function doAddapi()
    {
        $projectsModel = new Projects();
        //查询项目是否存在
        $data = $projectsModel->apiisexist($_POST['apiid'], $_POST['apiname'], $_POST['projectid']);
        if ($data) {
            $this->error('该接口已经存在，请重新输入', '/admin/adddocapi/' . $_POST['proid'] . "/" . $_POST['moduleid']);
        } else {
            $projectsModel->apiinsert($_POST);
            $this->success('保存成功', '/admin/docapis/' . $_POST['proid']);
        }
    }

    /**
     * 根据项目id获取此项目下的版块列表
     */
    public function getModuleByproid()
    {
        $projectsModel = new Projects();
        $modules = $projectsModel->promodules($_POST['proid']);
        return json($modules);
    }

    /**
     * 用户列表
     */
    public function Users()
    {
        $userModuel = new Users();
        $users = $userModuel->userlists();
        $this->assign("users", $users);
        return $this->fetch('users');
    }

    /**
     * 添加/编辑用户
     * @param $userid
     */
    public function addUser($userid=0)
    {
        $userModuel = new Users();
        if ($userid) {
            $userdata = $userModuel->userdetails($userid);
        } else {
            $userdata = $userModuel->toArray();
        }
        //获得项目列表
        $projectModel = new Projects();
        $prolists = $projectModel->projectlists();
        if ($userid) {
            for ($i = 0; $i < count($prolists); $i++) {
                $dic = $userModuel->userdic($userid, $prolists[$i]['projectid']);
                $prolists[$i]['prodic'] = $dic;
            }
        }
        $this->assign("userdata", $userdata);
        $this->assign("prolists", $prolists);
        return $this->fetch('adduser');
    }

    /**
     * 添加/编辑用户保存
     */
    public function doAddUser()
    {
        $userModuel = new Users();
        //查询用户是否存在
        $data = $userModuel->userisexist($_POST['userid'], $_POST['username']);
        if ($data) {
            $this->error('该用户已经存在，请重新输入', '/admin/adduser/' . $_POST['userid']);
        } else {
            $userModuel->userinsert($_POST);
            $this->success('保存成功', '/admin/users');
        }
    }

    //删除用户
    public function delUser($userid)
    {
        $userModuel = new Users();
        $result = $userModuel->deleteuser($userid);
        if ($result) {
            $this->error('你没权限删除,请联系管理员', '/admin/users');
        } else {
            $this->success('删除成功', '/admin/users');
        }
    }

}
