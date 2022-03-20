<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\node;
use App\Models\admin\role;
use App\Models\admin\RoleNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = role::get()->toArray();
//        dd($data);
        return view('admin.power.admin_role', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $data = getTreeList();
        return view('admin.power.admin_role_add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = $request->post();

        try {
            $id = role::insertGetId(['roleName' => $data['roleName']]);
            $node = $data['node'];
//        判断是否有子权限选中但是父权限没选中的情况
            $pid = [];
            foreach ($node as $v) {
                $res = node::find($v)->toArray();
                $node[] = $res['pid'];
            }
            $node = array_unique($node);

//        循环拼接插入数据库的数组
            $res = [];
            foreach ($node as $item) {
                $res[] = [
                    'role_id' => $id,
                    'node_id' => $item
                ];
            }
//         更新数据
//        开启事务
            DB::beginTransaction();
            try {
                RoleNode::where('role_id', $id)->delete();
                RoleNode::insert($res);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return errorX($exception->getMessage());
            }
        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $data = getTreeList();
        $role = role::where('id', $id)->first()->toArray();
//        查看用户当前权限
        $have = RoleNode::where('role_id', $id)->get()->toarray();
        $have = array_column($have, 'node_id');

        return view('admin.power.admin_role_edit', compact('data', 'role', 'have'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $data = $request->post();
        $node = $data['node'];
//        判断是否有子权限选中但是父权限没选中的情况
        $pid = [];
        foreach ($node as $v) {
            $res = node::find($v)->toArray();
            $node[] = $res['pid'];
        }
        $node = array_unique($node);

//        循环拼接插入数据库的数组
        $res = [];
        foreach ($node as $item) {
            $res[] = [
                'role_id' => $id,
                'node_id' => $item
            ];
        }
//         更新数据
//        开启事务
        DB::beginTransaction();
        try {
            RoleNode::where('role_id', $id)->delete();
            RoleNode::insert($res);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return errorX($exception->getMessage());
        }
        return successX('成功');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            role::find($id)->delete();
        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }
        return successX('删除成功');
    }

    public function delMany(Request $request)
    {
        $ids = $request->all()['id'];

        try {
            role::wherein('id', $ids)->delete();
        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }
        return successX('批量删除成功');
    }


}
