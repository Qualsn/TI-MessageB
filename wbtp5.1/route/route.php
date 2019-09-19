<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//前台路由
Route::rule('cate/:id','index/index/index','get');
Route::rule('/','index/index/index','get');
Route::rule('article-<id>','index/article/info','get');
Route::rule('register','index/index/register','get|post');
Route::rule('login','index/index/login','get|post');
Route::rule('loginout','index/index/loginout','get|post');
Route::rule('search','index/index/search','get');
Route::rule('comment','index/index/comment','post');

//后台路由
Route::group('admin',function (){
   Route::rule('/','admin/index/login','get|post');
   Route::rule('register','admin/index/register','get|post');
   Route::rule('index','admin/home/index','get');
   Route::rule('loginout','admin/home/loginout','post');
   Route::rule('cateadd','admin/cate/add','get|post');
   Route::rule('catelists','admin/cate/lists','post|get');
   Route::rule('catesort','admin/cate/sort','post');
   Route::rule('cateedit/[:id]','admin/cate/edit','post|get');
   Route::rule('cateedit','admin/cate/del','post');
   Route::rule('articleadd','admin/article/add','post|get');
   Route::rule('articlelist','admin/article/lists','post|get');
   Route::rule('articletop','admin/article/top','post|get');
   Route::rule('articleedit/[:id]','admin/article/edit','post|get');
   Route::rule('articledel','admin/article/del','post|get');
   Route::rule('memberadd','admin/member/add','post|get');
   Route::rule('memberlists','admin/member/lists','post|get');
   Route::rule('memberedit/[:id]','admin/member/edit','post|get');
   Route::rule('memberdel','admin/member/del','post|get');
   Route::rule('adminlists','admin/admin/lists','get|post');
   Route::rule('adminadd','admin/admin/add','get|post');
   Route::rule('adminstatus','admin/admin/status','post|get');
   Route::rule('adminedit/[:id]','admin/admin/edit','post|get');
   Route::rule('admindel','admin/admin/del','post|get');
   Route::rule('commentlist','admin/comment/lists','post|get');
   Route::rule('commentdel','admin/comment/del','post|get');
   Route::rule('systemset','admin/system/set','post|get');
   Route::rule('systemedit','admin/system/edit','post');
});