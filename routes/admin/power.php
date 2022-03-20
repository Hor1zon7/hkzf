<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PowerController;


Route::group(['prefix'=>'power','middleware'=>['ckAdmin']],function (){
    //    登录页面
    Route::get('index', [PowerController::class, 'index'])->name('power.index');

});
