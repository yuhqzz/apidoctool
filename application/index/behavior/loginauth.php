<?php
namespace app\index\behavior;
use think\Session;

/**
 *是否登录验证
 */
class LoginAuth
{
    use \traits\controller\Jump;
    public function run()
    {
        $session = Session::get('adminuser', 'admin');
        if (!$session) {
            return $this->error('请登录！', '/loginauth');
        }
    }
}