<?php

namespace App\Exports;

use App\Models\Traits\Fangattr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class TestExport implements FromArray
{
    private $type;
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function array(): array
    {
        $array=[];
//        switch ($this->type){
//            case 'fangattr':
//                $data=Fangattr::get()->toArray();
//                return $data;
//
//
//        }
        $data = [['a','b','c'],[1,2,3],[4,5,6],[7,8,9]];
        return $data;
//        $data = [[$this->id,$this->id,$this->id],[1,2,3],[4,5,6],[7,8,9]];//测试数据
//        return $data;
    }
}
