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

    //接口列表数据
    public function docapis($proid,$moduleid)
    {
        $where = "is_logic_del=0";
        if ($proid) {
            $where .= " AND projectid=$proid";
        }
        if ($moduleid) {
            $where .= " AND moduleid=$moduleid";
        }
        $modules = Db::table('doc_api')
            ->where($where)
            ->paginate(20,false,['query'=>request()->param()])->each(function($item, $key){
                //项目名称
                $proname = Db::table('doc_projects')->name('project_name')
                    ->where('projectid', $item['projectid'])
                    ->find();
                $item['project_name'] = $proname['project_name'];
                //版块名称
                $modulename = Db::table('doc_module')->name('module_name')
                    ->where('id', $item['moduleid'])
                    ->find();
                $item['module_name'] = $modulename['module_name'];
                //创建人姓名
                $createuser = Common::userdata($item['create_userid']);
                $item['create_user'] = $createuser['username'];
                //修改人姓名
                $createuser = Common::userdata($item['update_userid']);
                $item['update_user'] = $createuser['username'];
                return $item;
            });
        return $modules;
    }

    //接口详情
    public function apidetails($apiid)
    {
        $docapi = Db::table('doc_api')
            ->where('apiid', $apiid)
            ->find();
        //项目名称
        $proname = Db::table('doc_projects')->name('project_name')
            ->where('projectid', $docapi['projectid'])
            ->find();
        $docapi['project_name'] = $proname['project_name'];
        //版块名称
        $modulename = Db::table('doc_module')->name('module_name')
            ->where('id', $docapi['moduleid'])
            ->find();
        $docapi['module_name'] = $modulename['module_name'];
        //创建人姓名
        $createuser = Common::userdata($docapi['create_userid']);
        $docapi['create_user'] = $createuser['username'];
        //修改人姓名
        $createuser = Common::userdata($docapi['update_userid']);
        $docapi['update_user'] = $createuser['username'];
        //获取当前接口的请求参数
        $reqparams = Db::table('doc_params')
            ->where('apiid', $apiid)
            ->where('data_type', 0)
            ->select();
        $docapi['req_params'] = $reqparams;
        //获取当前接口的响应参数
        $resparams = Db::table('doc_params')
            ->where('apiid', $apiid)
            ->where('data_type', 1)
            ->select();
        $docapi['res_params'] = $resparams;
        return $docapi;
    }

    //查看当前项目下有没有此接口
    public function apiisexist($apiid, $apiname, $proid)
    {
        if ($apiid) {
            $apidata = Db::table('doc_api')
                ->where('apiid!=' . $apiid)
                ->where('api_name', $apiname)
                ->where('projectid', $proid)
                ->find();
        } else {
            $apidata = Db::table('doc_api')
                ->where('api_name', $apiname)
                ->where('projectid', $proid)
                ->find();
        }
        return $apidata;
    }

    //保存接口
    public function apiinsert($reqdata)
    {
        $userid = $this->user['userid'];
        $data = [
            "api_name" => $reqdata['apiname'],
            "moduleid" => $reqdata['moduleid'],
            "api_info" => $reqdata['apiinfo'],
            "api_url" => $reqdata['apiurl'],
            "api_test_url" => $reqdata['apitesturl'],
            "api_format" => $reqdata['apiformat'],
            "api_request" => $reqdata['apirequest'],
            "projectid" => $reqdata['projectid'],
            "success_result" => $reqdata['successresult'],
            "failed_result" => $reqdata['failedresult'],
            "update_time" => time(),
            "update_userid" => $userid,
        ];
        if ($reqdata['apiid']) {
            Db::table('doc_api')
                ->where('projectid=' . $reqdata['projectid'])
                ->where('apiid', $reqdata['apiid'])
                ->update($data);
            $apiid = $reqdata['apiid'];
        } else {
            $data['create_time'] = time();
            $data['create_userid'] = $userid;
            Db::table('doc_api')->insert($data);
            $apiid = Db::name('doc_api')->getLastInsID();
        }
        //保存请求/响应参数数据
        //清空原来的请求参数数据
        Db::table('doc_params')
            ->where('data_type', 0)
            ->where('apiid', $reqdata['apiid'])
            ->delete();
        for ($i = 0; $i < count($reqdata['reqname']); $i++) {
            $reqdta = [
                'param_name' => $reqdata['reqname'][$i],
                'param_type' => $reqdata['reqtype'][$i],
                'is_required' => $reqdata['reqisrequired'][$i],
                'max_length' => $reqdata['reqmaxlenth'][$i],
                'param_info' => $reqdata['reqinfo'][$i],
                'data_type' => 0,
                'apiid' => $apiid
            ];
            Db::table('doc_params')->insert($reqdta);
        }
        //清空原来的响应参数
        Db::table('doc_params')
            ->where('data_type', 1)
            ->where('apiid', $reqdata['apiid'])
            ->delete();
        for ($i = 0; $i < count($reqdata['resname']); $i++) {
            $reqdta = [
                'param_name' => $reqdata['resname'][$i],
                'param_type' => $reqdata['restype'][$i],
                'is_required' => $reqdata['resisrequired'][$i],
                'max_length' => $reqdata['resmaxlenth'][$i],
                'param_info' => $reqdata['resinfo'][$i],
                'data_type' => 1,
                'apiid' => $reqdata['apiid']
            ];
            Db::table('doc_params')->insert($reqdta);
        }
    }
}