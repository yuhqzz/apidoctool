<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Common extends Model
{
    //获取用户信息
    public static function userdata($userid)
    {
        $createuser = Db::table('doc_users')
            ->where('userid', $userid)
            ->find();
        return $createuser;
    }
}
