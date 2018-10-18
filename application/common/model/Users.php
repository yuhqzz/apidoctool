<?php
namespace app\common\model;

use think\Model;
use think\Db;
use think\Session;

class Users extends Model
{
    protected $pk = 'userid';
    protected $table = 'doc_users';
    protected $fillable = [];

    private $user;
    public function __construct()
    {
        //获取用户信息
        $userdata = Session::get('adminuser', 'admin');
        $this->user = $userdata;
    }


    //获取用户列表数据
    public function userlists()
    {
        if($this->user['username']!="admin"){
            $data = Db::table('doc_users')
                ->where("username!='admin'")
                ->paginate(20);
        }else{
            $data = Db::table('doc_users')
                ->paginate(20);
        }

        return $data;
    }

    //用户详情
    public function userdetails($userid)
    {
        $module = Db::table('doc_users')
            ->where('userid', $userid)
            ->find();
        return $module;
    }

    //查看当前用户是否有权限
    public function userdic($userid,$proid){
        //获取当前用户的项目数据
        $dicdata=Db::table('doc_jurisdiction')
            ->where('userid',$userid)
            ->where('projectid',$proid)
            ->find();
        return $dicdata?$dicdata['level']:-1;
    }

    //查看用户是否存在
    public function userisexist($userid,$username)
    {
        if ($userid) {
            $userdata = Db::table('doc_users')
                ->where('userid!=' . $userid)
                ->where('username', $username)
                ->find();

        } else {
            $userdata = Db::table('doc_users')
                ->where('username', $username)
                ->find();
        }
        return $userdata;
    }

    //用户保存
    public function userinsert($data)
    {
        $newdata = [
            "username" => $data['username'],
            "userpwd" => $data['userpwd'],
            "userpwd" => md5($data['userpwd']),
            "truepwd" => $data['userpwd'],
            "userlevel" => $data['userlevel']
        ];
        if ($data['userid']) {
            Db::table('doc_users')
                ->where('userid', $data['userid'])
                ->update($newdata);
            $userid=$data['userid'];
        } else {
            $data['regtime'] = time();
            Db::table('doc_users')->insert($newdata);
            $userid = Db::name('doc_users')->getLastInsID();
        }

        //删除用户原来的用户权限
        Db::table('doc_jurisdiction')
            ->where('userid',$userid)
            ->delete();
        //存入只读权限
        foreach ($data['proid'] as $readid) {
            $readdata = [
                'userid' => $userid,
                'projectid' => $readid,
                'level' => 0
            ];
            Db::table('doc_jurisdiction')
                ->insert($readdata);
        }
        //存入可读可写项目权限
        foreach ($data['editproid'] as $editid){
            //查询是否有
            $isdata=Db::table('doc_jurisdiction')
                ->where('userid',$userid)
                ->where('projectid',$editid)
                ->find();
            if($isdata){
                $editdata=[
                    'level'=>1
                ];
                Db::table('doc_jurisdiction')
                    ->where('userid',$userid)
                    ->where('projectid',$editid)
                    ->update($editdata);
            }else{
                $editdata = [
                    'userid' => $userid,
                    'projectid' => $editid,
                    'level' => 1
                ];
                Db::table('doc_jurisdiction')
                    ->insert($editdata);
            }
        }
    }

    //删除用户
    public function deleteuser($delid)
    {
        //只有超级管理员可以删除用户
        if ($this->user['username'] == "admin") {
            Db::table('doc_users')
                ->where('userid=' . $delid)
                ->delete();
            return 0;
        } else {
            //没有权限删除
            return 1;
        }
    }
}