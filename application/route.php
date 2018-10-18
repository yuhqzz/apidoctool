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
Route::rule('/aboutme','index/Index/aboutMe');
Route::rule('/blogwords','index/Index/blogWords');
Route::rule('/blogwordsnext','index/Index/blogWordsnext');
Route::rule('/gossips','index/Index/gossips');
Route::rule('/gossipsnext','index/Index/gossipsnext');

/**
 * 博客文章展示相关
 */
Route::group('blog',[
    '/[:typeid]'   => ['index/Blog/index', ['method' => 'get|post'],['typeid' => '\d+']],
    'dolike'=>['index/Blog/doLike',['method' => 'post']],
    'articlenext'=>['index/Blog/artnext',['method' => 'post']],
    'article/[:articleid]'   => ['index/Blog/articleDetail', ['method' => 'get']],
    'doshare'   => ['index/Blog/doShare', ['method' => 'post']],
    'docomment'   => ['index/Blog/userComment', ['method' => 'post']],
]);


/**
 * 博客数据相关数据接口
 */
Route::group('api',[
    '/[:cpage]'   => ['apiv1/Apiblog/index', ['method' => 'get|post'],['cpage' => '\d+']],
    'article'   => ['apiv1/Apiblog/artdetail', ['method' => 'get|post']],
    'dolike'=>['apiv1/Apiblog/artlike',['method' => 'get|post']],
    'dologin'=>['apiv1/Apiblog/wechatlogin',['method' => 'get|post']],
    'urlreturn'=>['apiv1/Apiblog/urlreturn',['method' => 'get|post']],
    'writecomm'=>['apiv1/Apiblog/artcomment',['method' => 'get|post']]
]);


/**
 * 微信相关数据接口
 */
Route::group('wechat',[
    'autoreply'=>['activity/Apiwechat/autoreply',['method' => 'get|post']],
    'test'=>['activity/Apiwechat/test',['method' => 'get']],
    'testsubmit'=>['activity/Apiwechat/testsubmit',['method' => 'post']],
]);