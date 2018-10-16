<?php
namespace app\admin\validate;

use think\Validate;
use think\Db;
use think\Request;

class Adminvalidate extends Validate
{
    protected $rule =   [
        'username'  => ['require','checkName'=>'username'],
        'password'   => 'require',
//        'captcha|验证码'=>'require|captcha'
    ];

    protected $message  =   [
        'username.require' => '登录名不能为空',
        'password.require' => '密码不能为空',
    ];

    //自定义验证；后台登录
    protected function checkName()
    {
        $data=Db::table('admin_users')
            ->where('LoginName',$_POST['username'])
            ->where('LoginPwd',md5($_POST['password']))
            ->find();
        if($data) {
            //记录IP
            $request = Request::instance();
            $clentip=$request->ip();
            Db::table('admin_users')
                ->where('LoginName',$_POST['username'])
                ->where('LoginPwd',md5($_POST['password']))
                ->update(['LoginIP' => $clentip, 'LoginTime' => time() ]);
        }
        return $data ? true : '账号或密码错误';
    }
}