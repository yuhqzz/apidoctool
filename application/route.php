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
Route::rule('adminauth','admin/Adminauth/Login');
Route::rule('adminauth/dologin','admin/Adminauth/doLogin','POST');
Route::rule('adminauth/index','admin/Adminauth/Index');

/**
 * 后台管理相关
 */
Route::group('admin',[
    //博客配置
    'system'   => ['admin/Admin/Systempage', ['method' => 'get']],
    'setsystem'   => ['admin/Admin/Setsystem', ['method' => 'post']],

    //文章分类
    'types'   => ['admin/Admin/Typelists', ['method' => 'get']],
    'addtype/[:typeid]' => ['admin/Admin/addType', ['method' => 'get']],
    'doAddtype' => ['admin/Admin/doAddtype', ['method' => 'post']],
    'deltype/:typeid' => ['admin/Admin/delType'],

    //文章管理
    'articles'   => ['admin/Admin/Articles', ['method' => 'get']],
    'addarticle/[:articleid]' => ['admin/Admin/addarticle', ['method' => 'get']],
    'doAddarticle' => ['admin/Admin/doAddarticle', ['method' => 'post']],
    'ajaxarticle' => ['admin/Admin/doAjaxarticle', ['method' => 'post']],
    'fileupload' => ['admin/Admin/fileupload', ['method' => 'post']],
    'delarticle/:articleid' => ['admin/Admin/delArticle'],

    //文章回收站
    'artrecycle'   => ['admin/Admin/artRecycle', ['method' => 'get']],
    'recycledel/:articleid' => ['admin/Admin/delRecycle'],

    //闲言碎语
    'gossips'   => ['admin/Admin/Gossips', ['method' => 'get']],
    'delgossip/:gossipid/:statusid' => ['admin/Admin/delGossip'],
    'addgossip/[:gossipid]' => ['admin/Admin/editGossip', ['method' => 'get']],
    'doAddGossip' => ['admin/Admin/doAddGossip', ['method' => 'post']],
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