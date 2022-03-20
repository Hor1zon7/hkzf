<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Traits\Fangattr;
use Illuminate\Http\Request;

class FangAttrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = Fangattr::getList();
        return view('admin.house.fang_attr', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $data = Fangattr::getList();
        return view('admin.house.fang_attr_add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'file']);
        Fangattr::insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
        $data = Fangattr::where('id', $id)->first()->toArray();
        $list = Fangattr::getList();
        return view('admin.house.fang_attr_edit', compact('data', 'list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', 'file']);
        Fangattr::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $res = Fangattr::where('pid', $id)->get()->toArray();
        //dd($res);
        if ($res) {
            return errorX('不能删除该属性');
        }
        Fangattr::where('id', $id)->delete();
        return successX('删除成功');
    }
}
