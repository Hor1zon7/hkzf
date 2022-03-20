<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
<!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/html5shiv.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset(__ADMIN_STATIC__)}}/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset(__ADMIN_LIB__)}}/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/skin/default/skin.css"
          id="skin"/>
    <link rel="stylesheet" type="text/css" href="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/css/style.css"/>

<!--[if IE 6]>
    <script type="text/javascript"
            src="{{asset(__ADMIN_LIB__)}}/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    {{--    引入datatables--}}
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8"
            src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <title>房源列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span
        class="c-gray en">&gt;</span> 房源列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
            class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="{{route('admin.adminList')}}">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin"
                   class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })"
                   id="datemax"
                   class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="key">
            <button type="submit" class="btn btn-success"><i
                    class="Hui-iconfont">&#xe665;</i> 搜用户
            </button>
    </form>
</div>
<div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="javascript:;" onclick="datadel()"
                                                           class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a href="javascript:;" onclick="house_add('添加房源','{{url('admin/fang/create')}}','800','500')"
               class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>添加房源</a>
    <a href="javascript:;" onclick="excel()"
       class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>导出EXCEL</a>
    </span>
    <span class="r">共有数据：<strong></strong> 条</span>
</div>
<table class="table table-border table-bordered table-bg" id="datatables">
    <thead>
    <tr>
        <th scope="col" colspan="11">员工列表</th>
    </tr>
    <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="40">ID</th>
        <th width="150">房源名称</th>
        <th width="90">小区名称</th>
        <th width="90">小区地址</th>
        <th width="40">租赁方式</th>
        <th>业主</th>
        <th width="130">租金</th>
        <th width="100">朝向</th>
        <th width="100">状态</th>
        <th width="100">操作</th>
    </tr>
    </thead>
    <tbody class="body">
    @foreach($data as $item)
        <tr class="text-c">
            <td><input type="checkbox" value="{{$item->id}}" name="single"></td>
            <td class="id">{{$item->id}}</td>
            <td>{{$item->fang_name}}</td>
            <td>{{$item->fang_xiaoqu}}</td>
            <td>{{$item->fang_addr}}</td>
            <td>{{$item->fang_rent_class}}</td>
            <td>{{$item->owner->name}}</td>
            <td>{{$item->fang_rent}}</td>
            <td>{{$item->fang_direction}}</td>
            <td>
                @if($item->fang_status==0)
                    <span class="label label-success radius" flag="0"
                          onclick="changeFangStatus(this,{{$item->id}})">未租</span>
                @else
                    <span class="label label-default radius" flag="1"
                          onclick="changeFangStatus(this,{{$item->id}})">已租</span>
                @endif
            </td>
            <td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,'10001')"
                                     href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a
                    title="编辑" href="javascript:;"
                    onclick="admin_edit('房源编辑','{{url("admin/fang/".$item->id."/edit")}}','1','800','600')"
                    class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                <a title="删除" href="javascript:;" onclick="admin_del(this,{{$item->id}})" class="ml-5"
                   style="text-decoration:none">
                    <i class="Hui-iconfont">&#xe6e2;</i></a>
                {{--                @if($item->id!=session('user_id'))--}}
                {{--                    {!!$item->deleteBtn('admin/deleteAdmin',$item->id)!!}--}}
                {{--                @endif--}}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="page">
    {{$data->withQueryString()->links()}}
</div>

</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_STATIC__)}}/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

    // $(document).ready(function () {
    //     $('#datatables').DataTable();
    // });
    /*
        参数解释：
        title	标题
        url		请求的url
        id		需要操作的数据id
        w		弹出层宽度（缺省调默认值）
        h		弹出层高度（缺省调默认值）
    */
    /*管理员-增加*/
    function house_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    function changeFangStatus(obj, id) {
        let text = $(obj).text();
        let status = '';
        if (text == '未租') {
            status = '1'
        } else {
            status = '0'
        }

        $.ajax({
            url: "http://www.hkzf.com/admin/changeFangStatus",
            data: {
                id: id,
                status: status
            },
            success: function (res) {
                console.log(res)
                if (text == '已租') {
                    $(obj).removeClass('label-default').addClass('label-success').html('未租');
                } else {
                    $(obj).removeClass('label-success').addClass('label-default').html('已租');
                }
            }
        })
    }




    // function excel() {
    //     $.ajax({
    //         url: "",
    //         success: function (res) {
    //             console.log(res);
    //         }
    //     })
    // }

    function datadel() {
        let ids = $("input[name='single']:checked");
        let id = [];
        $.each(ids, (key, val) => {
            id.push(val.value)
        })
        // 发送ajax请求批量删除
        $.ajax({
            url: 'http://www.hkzf.com/admin/dataDel',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (res) {
                if (JSON.parse(res).code == 200) {
                    layer.msg('已删除!', {icon: 1, time: 1000});
                    setTimeout(function () {
                        location.reload();
                    }, 1000)
                }
            }
        })

    }

    // 搜索
    {{--function search() {--}}
    {{--    let key = $("input[name='nameKey']").val();--}}

    {{--    $.ajax({--}}
    {{--        type: 'POST',--}}
    {{--        url: 'http://www.hkzf.com/admin/search',--}}
    {{--        headers: {--}}
    {{--            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
    {{--        },--}}
    {{--        data: {--}}
    {{--            key: key--}}
    {{--        },--}}
    {{--        dataType: 'json',--}}
    {{--        success: function (data) {--}}
    {{--            let res = data.data;--}}
    {{--            let arr = data.data.data;--}}
    {{--            let html = "";--}}
    {{--            arr.map(function (item, key) {--}}
    {{--                html += "<tr>" +--}}
    {{--                    "<td><input type='checkbox' value='{{$item->id}}' name='single'></td>" +--}}
    {{--                    "<td class='id'>" + item.id + "</td>" +--}}
    {{--                    "<td>" + item.username + "</td>" +--}}
    {{--                    "<td>" + item.phone + "</td>" +--}}
    {{--                    "<td>" + item.email + "</td>" +--}}
    {{--                    "<td>超级管理员</td>" +--}}
    {{--                    "<td>" + item.created_at + "</td>" +--}}
    {{--                    "<td class='td-status'><span class='label label-success radius'>已启用</span></td> <td class='td-manage'><a style='text-decoration:none' onClick='admin_stop(this,'10001')' href='javascript:;' title='停用'><i class='Hui-iconfont'>&#xe631;</i></a> <a title='编辑' href='javascript:;'onclick='admin_edit('管理员编辑','{{route('admin.adminEdit',['id'=>$item->id])}}','1','800','500')'class='ml-5' style='text-decoration:none'><i class='Hui-iconfont'>&#xe6df;</i></a> <a title='删除' href='javascript:;' onclick='admin_del(this," + item.id + ")' class='ml-5'style='text-decoration:none'> <i class='Hui-iconfont'>&#xe6e2;</i></a></td>"--}}
    {{--                    + "</tr>"--}}
    {{--            })--}}
    {{--            $('.body').html(html);--}}

    {{--        },--}}
    {{--        error: function (data) {--}}
    {{--            console.log(data.msg);--}}
    {{--        },--}}
    {{--    })--}}
    {{--}--}}

    /*管理员-删除*/
    function admin_del(obj, id) {

        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: 'http://www.hkzf.com/admin/deleteAdmin',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (data) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*管理员-编辑*/
    function admin_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
        console.log(id);
    }

    /*管理员-停用*/
    function admin_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……

            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
            $(obj).remove();
            layer.msg('已停用!', {icon: 5, time: 1000});
        });
    }

    /*管理员-启用*/
    function admin_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……

            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', {icon: 6, time: 1000});
        });
    }
</script>
</body>
</html>
<style>

    .pagination {
        display: -ms-flexbox;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: .25rem
    }

    .page-link {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6
    }

    .page-link:hover {
        z-index: 2;
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6
    }

    .page-link:focus {
        z-index: 2;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
    }

    .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: .25rem;
        border-bottom-left-radius: .25rem
    }

    .page-item:last-child .page-link {
        border-top-right-radius: .25rem;
        border-bottom-right-radius: .25rem
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6
    }

    .pagination-lg .page-link {
        padding: .75rem 1.5rem;
        font-size: 1.25rem;
        line-height: 1.5
    }

    .pagination-lg .page-item:first-child .page-link {
        border-top-left-radius: .3rem;
        border-bottom-left-radius: .3rem
    }

    .pagination-lg .page-item:last-child .page-link {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem
    }

    .pagination-sm .page-link {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5
    }

    .pagination-sm .page-item:first-child .page-link {
        border-top-left-radius: .2rem;
        border-bottom-left-radius: .2rem
    }

    .pagination-sm .page-item:last-child .page-link {
        border-top-right-radius: .2rem;
        border-bottom-right-radius: .2rem
    }
</style>
