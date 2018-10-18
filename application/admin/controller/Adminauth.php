<?php
/**
 * 后台登录相关操作
 * 作者：刘单风
 * 最后修改时间：2016-12-06
 * 版权：刘单风个人所有
 */
namespace app\admin\controller;
use think\Controller;
use think\Loader;
use think\Session;

class Adminauth extends Controller
{
    /**
     * 后台账号登录页面
     */
    public function Login()
    {
        // 临时关闭当前模板的布局功能
        $this->view->engine->layout(false);
        Session::set('adminuser',null,'admin');
        // 获取包含域名的完整URL地址
        $this->assign('domain',$this->request->url(true));
        return $this->fetch('login');
    }

    /**
     * 执行登录操作
     */
    public function doLogin()
    {
        //数据验证
        $validate = Loader::validate('Adminvalidate');
        if (!$validate->check($_POST)) {
            echo json_encode(1);
            exit;
        }
        //查询数据写入session
        $adminuser = db('doc_users')
            ->where('username', $_POST['username'])
            ->where('userpwd', md5($_POST['password']))
            ->find();
        if ($adminuser) {
            Session::set('adminuser', $adminuser, 'admin');
            if ($adminuser['userlevel'] == 1) {
                //普通用户,只能看,不能进入后台,重定向到前端首页
                echo json_encode(3);
                exit;
            } else {
                echo json_encode(0);
                exit;
            }

        } else {
            echo json_encode(2);
            exit;
        }
    }

    /**
     * 后台首页
     */
    public function Index()
    {
        $session = Session::get('adminuser', 'admin');
        $this->assign('userdata', $session);
        return $this->fetch('index');
    }

    /**
     * 退出登录
     */
    public function loginOut()
    {
        Session::set('adminuser',null,'admin');
        $this->success('退出成功！', '/loginauth');
    }
}
