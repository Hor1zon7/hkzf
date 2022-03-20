<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Renting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        $data = $request->post();
        $res = auth()->guard('apiweb')->attempt($request->all());
        if ($res) {
            $userModel = auth()->guard('apiweb')->user();
            $token = $userModel->createToken($userModel->id)->accessToken;
            return successX($token);
        }
        return errorX('API_ERROR');
    }

    public function logout()
    {
        dd(\Auth::user()->token()->revoke());
    }

    public function wxLogin(Request $request)
    {
        $code = $request->get('code');
        $secret = config('wx.secret');
        $appid = config('wx.appid');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";
        $content = json_decode(file_get_contents($url), true);
        $openid = $content['openid'];
        $res = Renting::where('openid', $openid)->first();
        if (empty($res)) {
            Renting::insert(['openid' => $openid]);
        }
        return successX($openid);
    }

    /**
     * 更新用户数据
     * @param Request $request
     * @return false|string
     */
    public function userinfo(Request $request)
    {
        $data = $request->post();
        $openid = $data['openid'];
        $data = $request->except(['openid']);
        Renting::where('openid', $openid)->update($data);
        return successX($data);
    }

    /**
     * 获取用户数据
     * @param Request $request
     * @return mixed
     */
    public function getuserinfo(Request $request)
    {
        $data = $request->get('openid');
        $data = Renting::where('openid', $data)->first();
        return $data;
    }

    public function setLoc(Request $request)
    {
        $data=$request->all();
        $lo=$data['longitude'];
        $la=$data['latitude'];
        $openid=$data['openid'];
        Redis::geoAdd('loc', $lo,$la,'loc_'.$openid);
        return successX();
    }


}
