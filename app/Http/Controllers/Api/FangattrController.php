<?php

namespace App\Http\Controllers\Api;

use App\Http\business\Api\FangattrBusiness;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FangattrController extends Controller
{
    /**
     * 获取房源属性
     * @return array
     */
    public function attr()
    {
        $data=(new FangattrBusiness())->attr();
        return $data;
    }
}
