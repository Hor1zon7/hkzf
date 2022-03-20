<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\role;
use App\Models\admin\RoleNode;
use App\Models\Article\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $power = getPowerList();
//        $data=\App\Models\admin\node::all()->toArray();
        return view('admin.power.admin_permission', compact('power'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $data = getPowerList();
        return view('admin.power.node_add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'node_name' => 'required|unique:node',
        ], [
            'route.unique' => '路由已被使用',
            'node_name.unique' => '权限已存在',
        ]);
        $data = $request->post();
//        向node表添加数据
        try {
            \App\Models\admin\node::create($request->except('_token'));
        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }
        return successX('添加成功');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article\Node $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Article\Node $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article\Node $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
//        查询该权限是否有角色使用
        $res = RoleNode::where('node_id', $id)->get()->toArray();
        $res2 = \App\Models\admin\node::where('pid', $id)->get()->toArray();
        if ($res || $res2) {
            return errorX('该权限正在被使用');
        }
        \App\Models\admin\node::where('id', $id)->delete();
        return successX('删除成功');
    }

    public function checkNode(Request $request)
    {
        $id=$request->all()['id'];
//        查看该节点是否被占用
        $res = RoleNode::where('node_id', $id)->get()->toArray();
        $res2 = \App\Models\admin\node::where('pid', $id)->get()->toArray();
        if ($res || $res2) {
            return errorX('该权限正在被使用');
        }
        return successX('权限闲置');
    }
}
