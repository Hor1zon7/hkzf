<?php

namespace App\Http\Controllers\Admin;

use App\Http\business\GaoDe;
use App\Http\Controllers\Controller;
use App\Models\Models\City;
use App\Models\Models\Fang;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Elasticsearch\ClientBuilder;

class FangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = Fang::with('owner')->orderBy('created_at', 'desc')->paginate(10);
//        dd($data->toArray());
        return view('admin.house.house_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Fang $fang)
    {
        $data = $fang->relationData();
        return view('admin.house.house_add', $data);
    }

    public function getCity(Request $request)
    {
        $id = $request->get('id');
        $data = City::where('pid', $id)->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'file']);

//        将房间配置转换为字符串
        $data['fang_config'] = implode(',', $data['fang_config']);
        $city = City::where('id', $data['fang_city'])->first()->toArray()['name'];
//        调用高德API获取经纬度

        $loc = GaoDe::getLoc($data['fang_addr'], $city);

        $data['longitude'] = $loc['lo'];
        $data['latitude'] = $loc['la'];

        $model = Fang::create($data);

//        实例化es客户端，将数据同步至es
        $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
        $params = [
            'index' => 'fang',
            'id' => $model->id,
            "body" => [
                'fang_name' => $model->fang_name,
                'fang_desn' => $model->fang_desn,
            ]
        ];
        $client->index($params);
    }

    public function esinit()
    {
//        实例化es客户端
        $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
//        创建索引
        $params = [
            "index" => 'fang',
            'body' => [
                'settings' => [
                    'number_of_shards' => 5,
                    'number_of_replicas' => 1,
                ],
                "mappings" => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'fang_name' => [
                            'type' => 'keyword'
                        ],
                        'fang_desn' => [
                            'type' => 'text',
                            'analyzer' => 'ik_smart',
                            'search_analyzer' => 'ik_smart'
                        ]
                    ]

                ]
            ]
        ];
        $response = $client->indices()->create($params);
        dump($response);
    }

    public function changeFangStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        Fang::where('id', $id)->update(['fang_status' => $status]);
        return successX($status);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Models\Fang $fang
     */
    public function show(Fang $fang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Models\Fang $fang
     */
    public function edit(Fang $fang)
    {
//        省份列表
        $province = City::where('pid', 0)->get()->toArray();
//        dd($fang->fang_city);
        $city_pid = City::where('id', $fang->fang_city)->first()['pid'];

        $city = City::where('pid', $city_pid)->get();

        $region_pid = City::where('id', $fang->fang_region)->first()['pid'];

        $region = City::where('pid', $region_pid)->get();

        $data = $fang->toArray();

        $data['province'] = $province;
        $data['city'] = $city->toArray();
        $data['region'] = $region->toArray();
        $relationData = $fang->relationData();
        return view('admin.house.house_edit', ['data' => $data, 'relationData' => $relationData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Models\Fang $fang
     */
    public function update(Request $request, Fang $fang)
    {
        $data = $request->except(['_token', 'file']);
        //将房间配置转换为字符串

        $city = City::where('id', $data['fang_city'])->first()->toArray()['name'];
        //调用高德API获取经纬度
        $loc = GaoDe::getLoc($data['fang_addr'], $city);
        $data['longitude'] = $loc['lo'];
        $data['latitude'] = $loc['la'];
        $data['fang_config'] = implode(',', $data['fang_config']);

        Fang::where('id', $fang->id)->update($data);
//        修改完成，更新ES的数据
        $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
        $params = [
            'index' => 'fang',
            'type' => '_doc',
            'id' => $fang->id,
            'body' => [
                'fang_name' => $data['fang_name'],
                'fang_desn' => $data['fang_desn'],
            ],
        ];
        $response = $client->index($params);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Models\Fang $fang
     */
    public function destroy(Fang $fang)
    {
        //
    }
}
