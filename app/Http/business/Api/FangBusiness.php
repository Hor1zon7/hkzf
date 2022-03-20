<?php

namespace App\Http\business\Api;

use App\Http\Controllers\Admin\FangController;
use App\Models\Models\Fang;
use App\Models\Traits\Fangattr;
use Illuminate\Support\Facades\Redis;


class FangBusiness
{
    public static function getRoomRecommend()
    {
        $field = [
            'id',
            'fang_name',
            'fang_pic'
        ];
        try {
            $data = Fang::where('is_recommend', '1')->orderBy('id', 'desc')->limit(5)->get($field)->append('pic');
            return $data;
        } catch (\Exception $exception) {
            throw new \Exception('服务器繁忙');
        }
    }

    public static function getRoomAttr($fieldName)
    {
        $field = [
            'id',
            'name',
            'icon'
        ];
        try {
//        获取该字段id
            $id = Fangattr::where('filed_name', $fieldName)->value('id');
            return $data = Fangattr::where('pid', $id)->limit(4)->get($field);
        } catch (\Exception $exception) {
            throw  new \Exception('服务器繁忙');
        }
    }

    public static function getRoomList($request)
    {
        $field = [
            'id',
            'fang_name',
            'fang_pic',
            'fang_shi',
            'fang_ting',
            'fang_rent',
            'fang_build_area',
            'latitude',
            'longitude'
        ];
        try {
            $builder = Fang::select($field);
            if ($request->has('fieldname')) {
                $builder->where($request->get('fieldname'), $request->get('fieldvalue'));
            }
            $data = $builder->paginate(10);
//            将所有的房屋经纬度存入redis的geo
            $all = Fang::all();
            foreach ($all as $item) {
                Redis::geoAdd('loc', $item->longitude, $item->latitude, 'loc_' . $item->id);
            }
            foreach ($data as $item) {
                $distance = Redis::geodist('loc', 'loc_' . $request->get('openid'), 'loc_' . $item->id, 'km');
                $item->distance = $distance;
            }
            return $data;
        } catch (\Exception $exception) {
            throw new \Exception('服务器繁忙');
        }
    }

    public static function getRoomDetail($fang)
    {
        $fang->owner;
        $fang->direction = Fangattr::where('id', $fang->fang_direction)->value('name');
        $fang->config = Fangattr::whereIn('id', $fang->fang_config)->get(['id', 'name', 'icon']);
        return $fang;
    }

    public static function getAllAttr()
    {
        try {
            $configPid = Fangattr::where('filed_name', 'fang_config')->value('id');
            $config = Fangattr::where('pid', $configPid)->get();
            $typePid = Fangattr::where('filed_name', 'fang_type')->value('id');
            $type = Fangattr::where('pid', $typePid)->get();
            $returnData = [
                'config' => $config,
                'type' => $type,
            ];
            return $returnData;
        } catch (\Exception $exception) {
            throw new  \Exception('服务器忙');
        }
    }

    public static function star($openid, $room_id)
    {
        $res = Redis::sismember('star_' . $openid, $room_id);
        if ($res) {
            Redis::srem('star_' . $openid, $room_id);
            return 0;
        }
        Redis::sadd('star_' . $openid, $room_id);
        return 1;
    }
}
