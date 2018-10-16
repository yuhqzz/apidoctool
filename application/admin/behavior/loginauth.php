<?php
namespace app\admin\behavior;

use think\Controller;
use think\Session;

/**
 *是否登录验证
 */
class LoginAuth
{
    use \traits\controller\Jump;
    public function run(){
       if(!Session::has('adminuser','admin')){
           return $this->error('请登录！','/adminauth');
       }
    }
}