<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Base extends Model
{
    use btn;

    public function editBtn($route, $id)
    {

        $user_id = session('user_id');
        $redisData = Redis::get('route_' . $user_id);
        if ($redisData == 1) {
            return "<button onClick='article_edit($id)'>编辑</button>";
        }
        if ($redisData == true && !in_array($route, array_merge($redisData, config('admin.allow_route')))) {
            return '';
        }
         return "<button onClick='article_edit($id)'>编辑</button>";
    }

    public function deleteBtn($route, $id)
    {
        $user_id = session('user_id');
        $redisData = Redis::get('route_' . $user_id);
        if ($redisData == 1) {
            return "<button onClick='article_del(this,$id)'>删除</button>";
        }
        if ($redisData == true && !in_array($route, array_merge($redisData, config('admin.allow_route')))) {
            return '';
        }
        return "<button onClick='article_del(this,$id)'>删除</button>";
    }
}
