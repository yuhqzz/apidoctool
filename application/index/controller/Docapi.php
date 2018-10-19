<?php
namespace app\index\controller;
use think\Controller;
use think\Hook;
class Docapi extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        Hook::listen('WebCheckAuth');
    }
    /**
     * 用户登录主页
     */
    public function userDefault(){
        $this->assign("menuselect", 1);
        return $this->fetch('index');
    }

}
