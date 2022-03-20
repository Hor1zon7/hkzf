<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fangattr extends Base
{
    use HasFactory;

    /**
     * 获取房源属性的列表
     * @return array
     */
    static public function getList()
    {
        $data = self::get()->toArray();
        return getTree($data);
    }

    /**
     * 获取房源属性的树状结构
     * @return array|mixed
     */
    static public function getTree()
    {
        $data = self::get()->toArray();
        return get_tree_list($data);
    }


//    API


}
