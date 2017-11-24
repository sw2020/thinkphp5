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
//api.myblog.com  =>>> www.myblog.com/index.php/api
Route::domain('api','api');
//获取验证码
Route::get('code/:time/:token/:username/:is_exist','code/get_code');
//用户注册
Route::post('User/register','user/register');
//用户登录
Route::post('User/login','user/login');
//用户头像上传
Route::post('User/icon','User/upload_head_icon');
//用户修改密码
Route::post('User/change_pwd','User/change_pwd');
//找回密码
Route::post('User/find_pwd','User/find_pwd');




return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
];

