<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Notice;
use App\Models\Models\Renting;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $openid=$request->get('openid');
        $renting_id=Renting::where('openid',$openid)->value('id');
        $data=Notice::with(['owner'])->where('renting_id',$renting_id)->get();
        return $data;
    }
}
