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
        $data = Db::table('doc_users')
            ->paginate(20);
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
        $data = [
            "username" => $data['username'],
            "userpwd" => $data['userpwd'],
            "userpwd" => md5($data['userpwd']),
            "truepwd" => $data['userpwd'],
            "userlevel" => $data['userlevel']
        ];
        if ($data['userid']) {
            Db::table('doc_users')
                ->where('userid', $data['userid'])
                ->update($data);
        } else {
            $data['regtime'] = time();
            Db::table('doc_users')->insert($data);
        }
    }
}