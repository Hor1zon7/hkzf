<?php

namespace App\Http\business;

class GaoDe
{
    public static function getLoc($addr,$city)
    {
        $url = config('gaode.geocode');
        $url = sprintf($url, $addr, $city);
//       使用curl发起高德请求
        $mapData = json_decode(file_get_contents($url), true);
        $loc = ($mapData['geocodes'][0]['location']);
        $loc = explode(',', $loc);
        return [
            'la'=>$loc[1],
            'lo'=>$loc[0],
        ];

        //        使用插件发起高德请求
//        $client = new Client(['timeout' => 5]);
//        $response = $client->get($url);
//        dd($url);
//        $body = (string)$response->getBody();
//        $arr = json_decode($body, true);
    }
}
