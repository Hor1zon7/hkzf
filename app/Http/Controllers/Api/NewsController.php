<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\article_count;
use App\Models\Traits\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $pagesize = 5;

//    初始化每页显示条数
    public function __construct()
    {
        $this->pagesize = config('page.pageSize');
    }

    public function index(Request $request)
    {
        //定义查询字段
        $key = [
            'id',
            'title',
            'desn',
            'pic',
            'created_at'
        ];
        $data = Article::orderBy('id', 'desc')->select($key)->paginate($this->pagesize);
        return $data;
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        $data = Article::where('id', $id)->first();
        return $data;
    }

    public function count(Article $article,Request $request)
    {
        $openid=$request->get('openid');
        $data=[
            'openid'=>$openid,
            'art_id'=>$article->id,
            'vdt'=>date('Y-m-d'),
            'vtime'=>time()
        ];
        try {
            $model=article_count::create($data);
        }catch (\Exception $e){
            return errorX('数据已存在');
        }
        return $model;
    }
}









