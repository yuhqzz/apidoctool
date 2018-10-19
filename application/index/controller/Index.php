<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    /**
     * 网站首页
     */
    public function index()
    {
        $this->assign("menuselect", 0);
        return $this->fetch('index');
    }

}
