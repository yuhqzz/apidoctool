<?php
namespace app\common\model;

use think\Model;
use think\Db;
use think\Session;

class Projects extends Model
{
    protected $pk = 'projectid';
    protected $table = 'doc_projects';
    protected $fillable = [];

    private $user;
    public function __construct()
    {
        //获取用户信息
        $userdata = Session::get('adminuser', 'admin');
        $this->user = $userdata;
    }

    /**
     * 获取项目列表
     * @param $userid
     */
    public function projectlists()
    {
        $userid = $this->user;
        if ($this->user['username'] == "admin") {
            //可查看所有项目
            $data = Db::table('doc_projects')
                ->where('is_logic_del',0)
                ->select();
        } else {
            //查看当前用户可以查看哪些项目
            $proids = Db::table('doc_jurisdiction')->name('projectid')
                ->where('userid', $userid)
                ->where('level', 1)
                ->select();
            $proidsnew = array();
            foreach ($proids as $item) {
                $proidsnew[] = $item['projectid'];
            }
            $data = Db::table('doc_projects')
                ->where('projectid', 'in', $proidsnew)
                ->where('is_logic_del',0)
                ->select();
        }
        //获取创建人姓名
        for ($i = 0; $i < count($data); $i++) {
            $createuser = Db::table('doc_users')->name('username')
                ->where('userid', $data[$i]['create_userid'])
                ->find();
            $data[$i]['create_user'] = $createuser['username'];
        }
        return $data;
    }

    /**
     * 项目详情
     * @param $proid
     */
    public function prodetails($proid)
    {
        $prodata = Db::table('doc_projects')
            ->where('projectid', $proid)
            ->find();
        return $prodata;
    }

    //查询项目是否存在
    public function proisexist($proid,$proname)
    {
        if ($proid) {
            $prodata = Db::table('doc_projects')
                ->where('projectid', '!=', $proid)
                ->where('project_name', $proname)
                ->find();
        } else {
            $prodata = Db::table('doc_projects')
                ->where('project_name', $proname)
                ->find();
        }
        return $prodata;
    }

    //新建项目
    public function proinsert($proid,$proname,$proinfo)
    {
        $userid = $this->user['userid'];
        $data = [
            "project_name" => $proname,
            "project_info" => $proinfo
        ];
        if ($proid) {
            Db::table('doc_projects')->where('projectid=' . $proid)->update($data);
        } else {
            $data['create_time'] = time();
            $data['create_userid'] = $userid;
            Db::table('doc_projects')->insert($data);
        }
    }

    //删除项目
    public function deletepro($proid)
    {
        $userid = $this->user['userid'];
        //查看当前用户是否有权限删除
        $proids = Db::table('doc_jurisdiction')->name('projectid')
            ->where('userid', $userid)
            ->where('projectid', $proid)
            ->where('level', 1)
            ->select();
        if ($proids || $this->user['username'] == "admin") {
            $data = ['is_logic_del' => 1];
            Db::table('doc_projects')->where('projectid=' . $proid)->update($data);
            return 0;
        } else {
            //没有权限删除
            return 1;
        }
    }

    //接口版块列表
    public function promodules($proid)
    {
        $userid = $this->user['userid'];
        //查看当前用户是否有权限查看
        $proids = Db::table('doc_jurisdiction')->name('projectid')
            ->where('userid', $userid)
            ->where('projectid', $proid)
            ->where('level', 1)
            ->select();
        if ($proids || $this->user['username'] == "admin") {
            $modules = Db::table('doc_module')
                ->where('projectid', $proid)
                ->where('is_logic_del', 0)
                ->select();
            //获取创建人姓名
            for ($i = 0; $i < count($modules); $i++) {
                $createuser = Db::table('doc_users')->name('username')
                    ->where('userid', $modules[$i]['create_userid'])
                    ->find();
                $modules[$i]['create_user'] = $createuser['username'];
            }
        }
        return $modules;
    }

    //接口版块详情
    public function moduledetails($moduleid)
    {
        $module = Db::table('doc_module')
            ->where('id', $moduleid)
            ->find();
        return $module;
    }

    //查看接口版块是否存在
    public function moduleisexist($proid,$modulename,$moduleid)
    {
        if ($moduleid) {
            $moduledata = Db::table('doc_module')
                ->where('id!='.$moduleid)
                ->where('module_name', $modulename)
                ->where('projectid', $proid)
                ->find();

        } else {
            $moduledata = Db::table('doc_module')
                ->where('module_name', $modulename)
                ->where('projectid', $proid)
                ->find();
        }
        return $moduledata;
    }

    //版块保存
    public function moduleinsert($proid,$modulename,$moduleid)
    {
        $userid = $this->user['userid'];
        $data = [
            "module_name" => $modulename,
            "projectid" => $proid
        ];
        if ($moduleid) {
            Db::table('doc_module')
                ->where('projectid=' . $proid)
                ->where('id', $moduleid)
                ->update($data);
        } else {
            $data['create_time'] = time();
            $data['create_userid'] = $userid;
            Db::table('doc_module')->insert($data);
        }
    }

    //删除版块
    public function deletemodule($proid,$moduleid)
{
    $userid = $this->user['userid'];
    //查看当前用户是否有权限删除
    $proids = Db::table('doc_jurisdiction')->name('projectid')
        ->where('userid', $userid)
        ->where('projectid', $proid)
        ->where('level', 1)
        ->select();
    if ($proids || $this->user['username'] == "admin") {
        $data = ['is_logic_del' => 1];
        Db::table('doc_module')
            ->where('projectid=' . $proid)
            ->where('id=' . $moduleid)
            ->update($data);
        return 0;
    } else {
        //没有权限删除
        return 1;
    }
}
}