<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\FangController;
use App\Http\Controllers\Api\FangattrController;
//
//Encryption keys generated successfully.
//Personal access client created successfully.
//Client ID: 1
//Client secret: KdXK27xooEck5sTOkpPKVb176Mn8y9m2AwrIBspJ


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>\App\Http\Middleware\Throttle::class,'prefix'=>'v1','namespace'=>'Api'], function () {
    Route::get('login', [LoginController::class, function(){return 'token过期';}])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:api'], function () {
//        微信登录接口
        Route::get('wxLogin', [LoginController::class, 'wxLogin'])->name('wxLogin');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//        更新用户数据
        Route::get('user/userinfo',[LoginController::class,'getuserinfo']);
//        获取用户数据
        Route::post('user/userinfo',[LoginController::class,'userinfo']);
//        上传头像
        Route::post('user/upload',[UserController::class,'upload']);
//        上传身份证
        Route::post('user/IdCardUpload',[UserController::class,'IdCardUpload']);
//        用户资料更新
        Route::post('userUpdate',[UserController::class,'userUpdate']);
//        设置用户地理位置
        Route::get('setLoc',[LoginController::class,'setLoc']);
//        用户收藏列表
        Route::get('getCollect',[UserController::class,'getCollect']);

        Route::resource('user','\App\Http\Controllers\Api\UserController');

//        看房通知
        Route::get('notices',[NoticeController::class,'index']);

//        资讯接口
        Route::get('news',[NewsController::class,'index']);
//        资讯详情
        Route::get('show',[NewsController::class,'show']);

        //资讯用户访问记录
        Route::post('news/{article}',[NewsController::class,'count']);

//        房源列表
        Route::get('fangs',[FangController::class,'fang']);
//        推荐房源
        Route::get('fangs/recommend',[FangController::class,'recommend']);
//        房源属性
        Route::get('fangs/attr',[FangController::class,'attr']);
//        房源详情
        Route::get('fangs/{fang}',[FangController::class,'detail']);
//        房源添加页面的属性元素
        Route::get('fangattr',[FangController::class,'fangAttr']);
//        房源文件上传
        Route::post('upload',[FangController::class,'upload']);
        Route::post('issue',[FangController::class,'issueRoom']);
//        ES搜索
        Route::get('esSearch',[FangController::class,'esSearch']);
//        ES搜索记录
        Route::get('searchHistory',[FangController::class,'searchHistory']);
//        收藏功能
        Route::get('star',[FangController::class,'star']);
//        房源属性接口
        Route::get('fangattrs',[FangattrController::class,'attr']);
    });
});
//Route::get('uploadToken',[FangController::class,'uploadToken']);

//Route::get('error',[\App\Http\Controllers\Api\LoginController::class,'error']);


