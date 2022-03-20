<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lib\Qiniu;
use App\Models\Models\Fang;
use App\Models\Models\Renting;
use App\Models\Traits\Fangattr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function upload(Request $request)
    {
        $filename = Qiniu::qiniuUpload($request->file('avatar'));
        return $filename;
//        $file = $request->file('avatar')->store('', 'avatar');
//
//        $filePath = '/uploads/avatar/' . $file;
        return 'http://www.hkzf.com' . $filePath;
    }

//    上传身份证
    public function IdCardUpload(Request $request)
    {
        $file = $request->file('card')->store('', 'IDcard');
        $filePath = '/uploads/IDcard/' . $file;
        return 'http://www.hkzf.com' . $filePath;
    }

    public function update(Request $request, $id)
    {
        $data = $request->post();
        Renting::where('openid', $id)->update($data);
        return successX();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function userUpdate(Request $request)
    {
        $openid = $request->get('openid');
        $data = $request->except(['openid']);
//        判断用户是否上传图片
        if (empty($request->get('avatar'))) {
            unset($data['avatar']);
        }
        Renting::where('openid', $openid)->update($data);
        return successX('更新成功');
    }

    public function getCollect(Request $request)
    {

        $openid = $request->get('openid');
        $ids = Redis::smembers('star_' . $openid);
//        foreach($ids as $k=>$v){
//            $ids[$k]=substr($v,strpos('_',$v));
//        }
//        dd($ids);
        $data = Fang::whereIn('id', $ids)->get();
        foreach ($data as $v) {
            $v->owner;
            $v->direction = Fangattr::where('id', $v->fang_direction)->value('name');
            $v->config = Fangattr::whereIn('id', $v->fang_config)->get(['id', 'name', 'icon']);
        }
        return $data;
    }
}
