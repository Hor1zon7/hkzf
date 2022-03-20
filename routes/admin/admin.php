<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\PowerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\NodeController;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
//    登录页面
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
//    处理登录
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    //定义图形验证码路由
    Route::get('img_code', [LoginController::class, 'login'])->name('admin.img_code');

//    后台需要验证中间件
//    Route::group(['middleware' => ['ckAdmin']], function () {
    Route::group(['middleware' => ['ckAdmin']], function () {
        //主页
        Route::get('index', [IndexController::class, 'index'])->name('admin.index');
        //欢迎页面
        Route::get('welcome', [IndexController::class, 'welcome'])->name('admin.welcome');
        //管理员列表
        Route::get('adminList', [IndexController::class, 'adminList'])->name('admin.adminList');
//        管理员添加
        Route::get('adminAdd', [AdminController::class, 'adminAdd'])->name('admin.adminAdd');
        Route::post('adminDoAdd', [AdminController::class, 'adminDoAdd'])->name('admin.adminDoAdd');
//        管理员编辑
        Route::get('adminEdit', [AdminController::class, 'adminEdit'])->name('admin.adminEdit');
        Route::post('adminDoEdit', [AdminController::class, 'adminDoEdit'])->name('admin.adminDoEdit');
//        删除
        Route::post('deleteAdmin', [AdminController::class, 'deleteAdmin'])->name('admin.deleteAdmin');
//        批量删除
        Route::get('dataDel', [AdminController::class, 'dataDel'])->name('admin.dataDel');
        //退出登录
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

//        管理员权限管理
        Route::get('adminRole', [PowerController::class, 'index'])->name('admin.adminRole');
//        添加角色
        Route::get('roleAdd', [PowerController::class, 'roleAdd'])->name('admin.roleAdd');
        Route::post('roleDoAdd', [PowerController::class, 'roleDoAdd'])->name('admin.roleDoAdd');

//        角色管理的资源路由
        Route::resource('role', "\App\Http\Controllers\Admin\RoleController");
        Route::get('delMany', [RoleController::class, 'delMany']);

//        权限管理
        Route::resource('node', "\App\Http\Controllers\Admin\NodeController");

        Route::get('checkNode', [NodeController::class, 'checkNode'])->name('admin.checkNode');

//        文章管理
        Route::resource('article', "\App\Http\Controllers\Admin\ArticleController");
        Route::get('getArticle', [\App\Http\Controllers\Admin\ArticleController::class, 'getArticle']);
        Route::post('uploader', [\App\Http\Controllers\Admin\ArticleController::class, 'uploader']);

//        房源管理
        Route::resource('house', "\App\Http\Controllers\Admin\HouseController");
//        房源属性管理
        Route::resource('fangattr', '\App\Http\Controllers\Admin\FangAttrController');

//        导出excel
        Route::get('fangownerExcel', [\App\Http\Controllers\Admin\FangOwnerController::class, 'excel']);

//        房东管理
        Route::resource('fangowner', '\App\Http\Controllers\Admin\FangOwnerController');
        Route::get('ownerpicDel', [\App\Http\Controllers\Admin\FangOwnerController::class, 'ownerpicDel']);
        Route::get('checkPhoto', [\App\Http\Controllers\Admin\FangOwnerController::class, 'checkPhoto']);

//        房源管理
        Route::resource('fang', '\App\Http\Controllers\Admin\FangController');
        Route::get('getCity', [\App\Http\Controllers\Admin\FangController::class, 'getCity']);
        Route::get('es/init', [\App\Http\Controllers\Admin\FangController::class, 'esinit']);
        Route::get('changeFangStatus', [\App\Http\Controllers\Admin\FangController::class, 'changeFangStatus']);

//        预约管理
        Route::resource('notice', '\App\Http\Controllers\Admin\NoticeController');

//        接口账号管理
        Route::resource('apiuser', '\App\Http\Controllers\Admin\ApiuserController');

    });
});




