<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('admin.article.article_list');
    }

    public function getArticle(Request $request)
    {
        if ($request->header('X-Requested-With') == 'XMLHttpRequest') {

            $start = $request->get('start', 0);
            $length = $request->get('length');
            $total = \App\Models\Traits\Article::count();
            $data = \App\Models\Traits\Article::offset($start)->limit($length)->get()->append('action');
            $result = [
                'draw' => $request->get('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
            return $result;
        }
    }

    public function uploader(Request $request)
    {
        if ($request->hasFile('swift') && $request->file('swift')->isValid()) {
            // 获取上传文件
            $file = $request->file('swift');
            // 获取文件后缀
            $ext = $file->getClientOriginalExtension();
            // 获取上传文件大小
            $size = $file->getSize();

            // 允许文件上传格式
            $allowExt = ['jpg', 'jpeg', 'gif', 'png', 'JPG'];
            // 允许文件上传大小
            $allowSize = 1024 * 1024*5;
            // 新文件名
            $newFileName = date('Ymd') . rand(100000, 999999) . '.' . $ext;
//            if (!in_array($ext, $allowExt)) {
//                return ['code' => 400, 'msg' => '非法文件上传'];
//            }
            if ($size > $allowSize) {
                return ['code' => 401, 'msg' => '上传文件过大'];
            }
            $destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
            $extension = $file->getClientOriginalExtension();
            $fileName = md5(time() . rand(1, 1000)) . '.' . $extension;
            $file->move($destinationPath, $fileName);
            $filePath = asset($destinationPath . $fileName);
            return json_encode($filePath,JSON_UNESCAPED_UNICODE);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

        return view('admin.article.article_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except(['_token','file']);
        \App\Models\Traits\Article::create($data);

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
        $data=\App\Models\Traits\Article::where('id',$id)->first()->toArray();
        return view('admin.article.article_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        \App\Models\Traits\Article::where('id',$id)->delete();
        return successX();
    }
}
