<?php

namespace App\Http\business\Api;

use App\Models\Traits\Fangattr;

class FangattrBusiness
{
    private $_attr = [
        'fang_group' => 6,
        'fang_rent_type' => 28,
        'fang_direction' => 18,
        'fang_rent_class' => 1

    ];

    public function attr()
    {
        $arr = [];
        foreach ($this->_attr as $key => $value) {
            $arr[$key]=Fangattr::where('pid',$value)->get(['id','name']);
        }
        return $arr;
    }

}
