<?php

namespace App\Lib;

use Elasticsearch\ClientBuilder;

class ES
{
    public $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    /**
     * 初始化
     * @return void
     */
    public static function init()
    {
        $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
// 创建索引
        $params = [
// 生成索引的名称
            'index' => 'fang',
// 类型 body
            'body' => [
                'settings' => [
// 分区数
                    'number_of_shards' => 5,
// 副本数
                    'number_of_replicas' => 1
                ],
                'mappings' => [
                    '_doc' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'fang_name' => [
                                'type' => 'keyword'
                            ],
                            'fang_desn' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word',
                                'search_analyzer' => 'ik_max_word'
                            ]
                        ]
                    ]
                ]
            ]
        ];
// 创建索引
        $response = $client->indices()->create($params);
    }

//    public static function search($index, $key, )
//    {
//        $client = ClientBuilder::create()->build();
//        $response = $client->search([
//            'index' => $index,
////            'type' => 'my_type',
//            'body' => [
//                'query' => [
//                    'match' => [
//                        $key => $param
//                    ]
//                ]
//            ]
//        ]);
//    }

    //es搜索
    public static function esSearch($param)
    {
        $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
        $word = $param;
        $page = 1;//接收当前页，默认值是1
        $size = 10;//每页显示条数
        $from = ($page - 1) * $size;//偏移量
        $params = [
            'index' => 'fang',
            'body' => [
                //执行
                'query' => [
                    //匹配
                    'match' => [
                        'fang_name' =>
                            [
                                'query' => $word,
//                                'analyzer'=>"ik_smart"
                            ]

                    ]
                ],
                'highlight' => [
                    'pre_tags' => ["<span style='color: orangered'>"],
                    'post_tags' => ["</span>"],
                    'fields' => [
                        'fang_name' => new \stdClass()
                    ]
                ]
            ],
            'size' => $size,//每页显示的条数
            'from' => $from//偏移量
        ];

        $res = $client->search($params);
        $data = $res['hits']['hits'];
        foreach ($data as $k => $v) {
            $data[$k]['_source']['fang_name'] = $v['highlight']['fang_name'][0];
        }
        $data = array_column($data, '_source');
        return $data;


    }

}
