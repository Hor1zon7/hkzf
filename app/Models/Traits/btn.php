<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Redis;

trait btn
{
    public function deleteBtn($route, $id)
    {
        $user_id = session('user_id');
//        判断是否为超级管理员
        if (Redis::get('route_' . $user_id) == 1) {
            return "<a title='删除' href='javascript:;' onclick='admin_del(this,$id)' class='ml-5'
                   style='text-decoration:none'>
                    <i class='Hui-iconfont'>&#xe6e2;</i></a>";
        }

        if (json_decode(Redis::get('route_' . $user_id)) == true && !in_array($route, array_merge(json_decode(Redis::get('route_' . $user_id)), config('admin.allow_route')))) {
            return '';
        }
        return "<a title='删除' href='javascript:;' onclick='admin_del(this,$id)' class='ml-5'
                   style='text-decoration:none'>
                    <i class='Hui-iconfont'>&#xe6e2;</i></a>";
    }

    public function editBtn($route, $id)
    {
        $user_id = session('user_id');
        if (Redis::get('route_' . $user_id) == 1) {
            return "<a title='删除' href='javascript:;' onclick='admin_del(this,$id)' class='ml-5'
                   style='text-decoration:none'>
                    <i class='Hui-iconfont'>&#xe6e2;</i></a>";
        }

        if (json_decode(Redis::get('route_' . $user_id)) == true && !in_array($route, array_merge(json_decode(Redis::get('route_' . $user_id)), config('admin.allow_route')))) {
            return '';
        }
        return "<a title='删除' href='javascript:;' onclick='admin_del(this,$id)' class='ml-5'
                   style='text-decoration:none'>
                    <i class='Hui-iconfont'>&#xe6e2;</i></a>";
    }

}
