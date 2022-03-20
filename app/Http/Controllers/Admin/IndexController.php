<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use App\Models\Models\Fang;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $id=session('user_id');
        $list = json_decode(Redis::get('list_'.$id),JSON_UNESCAPED_UNICODE);
//        dd($list);
        return view('admin.index.index',compact('list'));
    }

    public function welcome()
    {
//        获取房间统计数据
        $data=(new Fang())->fangCount();
        return view('admin.index.welcome',$data);
    }

    public function adminList(Request $request)
    {
        $where = [];
        if ($request->has('key') && !empty($request->all('key'))) {
            $key = $request->all()['key'];
            $where[] = ['username', 'like', "%$key%"];
        }
        Paginator::useBootstrap();
//        $data = Admin::where($where)->orderBy('id', 'desc')->with(['getRole'])->orderBy('id', 'desc')->paginate(10);
        $data = Admin::where($where)->orderBy('id', 'desc')->with(['getRole'])->orderBy('id', 'desc')->get();

//        dd($data->toArray());
        return view('admin.index.admin_list', ['data' => $data]);
    }
}
