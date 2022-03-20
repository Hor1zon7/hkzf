<?php

namespace App\Http\Controllers\Api;

use App\Http\business\Api\FangBusiness;
use App\Http\Controllers\Controller;
use App\Lib\ES;
use App\Lib\Qiniu;
use App\Models\Models\Fang;
use App\Models\Models\Fang2;
use App\Models\Models\Renting;
use App\Models\Traits\Fangattr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Qiniu\Auth;

class FangController extends Controller
{
    /**
     * 房源推荐
     * @param Request $request
     * @return mixed
     */
    public function recommend(Request $request)
    {
        try {
            $data = FangBusiness::getRoomRecommend();
            return response()->json($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * 房源属性
     * @param Request $request
     * @return mixed
     */
    public function attr(Request $request)
    {
        try {
            $fieldName = $request->get('field_name');
            $data = FangBusiness::getRoomAttr($fieldName);
            return response()->json($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }

    }

    public function fang(Request $request)
    {
        try {
//            $openid = $request->get('openid');
            $data = FangBusiness::getRoomList($request);
            return response()->json($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function detail(Fang $fang)
    {
        try {
            $data = FangBusiness::getRoomDetail($fang);
            return $data;
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function fangAttr()
    {
        try {
            $data = FangBusiness::getAllAttr();
            return $data;
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function upload(Request $request)
    {
        try {
            $file = $request->file('file');
            $res = Qiniu::qiniuUpload($file, 'room');
            return $res;
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * 收藏功能
     */
    public function star(Request $request)
    {
        try {
            $openid = $request->get('openid');
            $room_id = $request->get('id');
            $res = FangBusiness::star($openid, $room_id);
            if ($res == 1) {
                return successX('', '', 291);
            } else {
                return successX('', '', 290);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }


    }

    /**
     * 租房信息添加
     * @param Request $request
     * @return void
     */
    public function issueRoom(Request $request)
    {
        $data = $request->except(['pic']);
        $openid = $data['openid'];
        //根据openid获取房东id
        $id = Renting::where('openid', $openid)->value('id');
        unset($data['openid']);
        $data['fang_owner'] = 34;
        $data['fang_config'] = implode(',', $data['config']);
        unset($data['config']);

        Fang2::create($data);
    }

    public function esSearch(Request $request)
    {
        $word = $request->get('word');
        $openid = $request->get('openid');

        if (!empty($word)) {
            //记录搜索记录
            Redis::sadd('search_' . $openid, $word);
            $data = ES::esSearch($word);
            return $data;
        }
        return response()->json([]);
    }

    public function searchHistory(Request $request)
    {
        $openid = $request->get('openid');
        $data = Redis::smembers('search_' . $openid);
        return $data;
    }

    public function uploadToken()
    {
        $auth = new Auth('GqTw-O6tEapJJRmrayDksBE_8v_9XrEmlyfPPiEA', 'LjiDtz-BnCu1ptUBbEk1Slp8UymUFJyve9WROXLv');
        $bucket = 'hor1zon7';
        $token = $auth->uploadToken($bucket);
        return json_encode(['uptoken' => $token]);
    }


}
