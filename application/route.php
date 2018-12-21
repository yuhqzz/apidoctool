<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

/**
 * 登陆
 */
Route::rule('loginauth','admin/Adminauth/Login');
Route::rule('adminauth/dologin','admin/Adminauth/doLogin','POST');
Route::rule('adminauth/index','admin/Adminauth/Index');
Route::rule('adminauth/loginOut','admin/Adminauth/loginOut');

/**
 * 后台管理相关
 */
Route::group('admin',[

    //项目列表
    'projects'   => ['admin/Admin/Projectlists', ['method' => 'get']],
    'addProject/[:proid]' => ['admin/Admin/addProject', ['method' => 'get']],
    'doAddProject' => ['admin/Admin/doAddProject', ['method' => 'post']],
    'delProject/:proid' => ['admin/Admin/delProject'],

    //接口版块列表
    'modules/:proid'   => ['admin/Admin/Apimodules', ['method' => 'get']],
    'addModule/:proid/[:moduleid]' => ['admin/Admin/addModule', ['method' => 'get']],
    'doAddmodule' => ['admin/Admin/doAddmodule', ['method' => 'post']],
    'delModule/:proid/:moduleid' => ['admin/Admin/delModule'],

    //接口列表数据
    'docapis/[:proid]/[:moduleid]'   => ['admin/Admin/Docapis', ['method' => 'get']],
    'addDocapi/:proid/:moduleid/[:apiid]' => ['admin/Admin/addDocapi'],
    'doAddapi' => ['admin/Admin/doAddapi', ['method' => 'post']],
    'getModuleByproid' => ['admin/Admin/getModuleByproid', ['method' => 'post']],

    //用户管理
    'users'   => ['admin/Admin/Users', ['method' => 'get']],
    'addUser/[:userid]' => ['admin/Admin/addUser'],
    'doAddUser' => ['admin/Admin/doAddUser', ['method' => 'post']],
    'delUser/:userid' => ['admin/Admin/delUser'],
]);


/**
 * 网站首页通用相关
 */
Route::rule('/','index/Index/index','GET');

/**
 * 前端相关页面
 */
Route::group('docapi',[
    '/'   => ['index/Docapi/userDefault', ['method' => 'get']],
    'projects'=>['index/Docapi/userProject',['method' => 'get']],
    'prorules/:proid'=>['index/Docapi/prorules',['method' => 'get']],
    'apis/[:proid]/[:moduleid]/[:apiid]'=>['index/Docapi/userApis',['method' => 'get']],
    'details' => ['index/Docapi/apidetails', ['method' => 'post']],
    'apitest/[:apiid]'=>['index/Docapi/apitest',['method' => 'get']],
    'doapitest' => ['index/Docapi/doapitest', ['method' => 'post']],
]);

