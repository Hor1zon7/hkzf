<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FangOwnerExport;
use App\Http\Controllers\Controller;
use App\Models\admin\FangOwner;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
define('__DOCUMENT_PATH__',substr(__FILE__ ,0,-10) );
class FangOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = FangOwner::paginate('10');
        $total = $data->toArray()['total'];
        return view('admin.fangowner.fang_owner_list', compact('data', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.fangowner.house_owner_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'file']);
//        $data=$request->file();
        FangOwner::insert($data);
        return successX();
    }

    public function ownerpicDel(Request $request)
    {
        $src = $request->all()['src'];
        $src = str_replace('http://www.hkzf.com/', '', $src);
        unlink($src);
        return successX();
    }

    public function excel(\Illuminate\Http\Request $request)
    {
        return Excel::download(new FangOwnerExport(), 'fangdong.xlsx');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(FangOwner $fangOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $data = FangOwner::where('id', $id)->first();
        $pic=$data->toArray()['pic'];
        $pic=array_filter(explode('#',$pic));
        return view('admin.fangowner.house_owner_edit',compact('data','pic'));
//        return view('admin');
    }

    public function checkPhoto(Request $request)
    {
        $id=$request->get('id');
        $data=FangOwner::where('id',$id)->first()->toArray();
        $data=$data['pic'];
        $data=array_filter(explode('#',$data));
        array_map(function ($item){
            echo "<div><img src=$item alt='' width='150px'></div>";
        },$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update($id,Request $request)
    {
        $data=$request->except(['_token','file']);
        FangOwner::where('id',$id)->update($data);
        return successX();
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(FangOwner $fangOwner)
    {
        //
    }
}
