<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.login');
    }

    public function login(Request $request)
    {

        $res = $request->post();
        $role = [
            'username' => 'required',
            'password' => 'required'
        ];
        $message = [
            'username.required' => "请填写账号",
            'password.required' => "请填写密码"
        ];
        $validator = \Validator::make($res, $role, $message);
        if ($validator->fails()) {
            $request->flash();
            $error = $validator->errors()->all();
            return redirect(route('admin.login'))->withErrors(['error' => $error]);
        }

        unset($res['_token']);
//        登录
        $bool = auth()->attempt($res);
        if ($bool) {
//            判断是否为超级管理员
            if (auth()->user()->username == config('admin.super_admin')) {
                Redis::set('route_' . auth()->id(),true);
//                \Cache::store('redis')->set('route_' . auth()->id(), true);
            } else {
                $adminModel = auth()->user();
                $roleModel = $adminModel->getRole;
                $route = $roleModel->getNode()->pluck('route', 'id')->toArray();
//                将管理员权限存入redis
                Cache::store('redis')->set('route_' . auth()->id(), $route);
            }
            //id存入session
            session(['user_id' => auth()->id()]);
            $data = Admin::with(['getRole', 'getRole.getNode'])->where('id', auth()->id())->first()->toArray();
            $list = $data['get_role']['get_node'];
            $list = get_tree_list($list);
            Redis::set('list_' . auth()->id(), json_encode($list, JSON_UNESCAPED_UNICODE));
            return redirect(route('admin.index'));
        }
        return redirect(route('admin.login'))->withErrors(['error' => '登录失败']);


    }

    /**
     * 退出
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->logout();
        return redirect(route('admin.login'))->with('success', '请重新登录');
    }
}
