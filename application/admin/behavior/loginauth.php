<?php
namespace app\admin\behavior;

use think\Session;

/**
 *是否登录验证
 */
class LoginAuth
{
    use \traits\controller\Jump;
    public function run(){
       if(!Session::has('adminuser','admin')){
           return $this->error('请登录！','/loginauth');
       }else{
           $session = Session::get('adminuser', 'admin');
           if( $session ['userlevel']==1){
               $this->redirect('/');
           }
       }
    }
}