<?php
if (!function_exists("successX")) {
    function successX($data = [], $msg = 'success', $code = 200)
    {
        return json_encode([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ], JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists("errorX")) {
    function errorX($msg = '', $code = 500, $data = [])
    {
        return json_encode([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ], JSON_UNESCAPED_UNICODE);
    }
}

function getPowerList()
{
    $data = \App\Models\admin\node::get()->toArray();
//    递归处理
    return getTree($data);
}

function getTree($data, $pid = 0, $level = 0)
{
    //声明静态数组,避免递归调用时,多次声明导致数组覆盖
    static $list = [];
    foreach ($data as $key => $value) {
        //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
        if ($value['pid'] == $pid) {
            //父节点为根节点的节点,级别为0，也就是第一级
            $value['level'] = $level;
            //把数组放到list中
            $list[] = $value;
            //把这个节点从数组中移除,减少后续递归消耗
            unset($data[$key]);
            //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
            getTree($data, $value['id'], $level + 1);
        }
    }
    return $list;
}


function getTreeList()
{
    $data = \App\Models\admin\node::get()->toArray();
//    递归处理
    return get_tree_list($data);
}

if(!function_exists('get_tree_list')){
    //引用方式实现 父子级树状结构
    function get_tree_list($list){
        //将每条数据中的id值作为其下标
        $temp = [];
        foreach($list as $v){
            $v['son'] = [];
            $temp[$v['id']] = $v;
        }
        //获取分类树
        foreach($temp as $k=>$v){
            $temp[$v['pid']]['son'][] = &$temp[$v['id']];
        }
        return isset($temp[0]['son']) ? $temp[0]['son'] : [];
    }
}






















