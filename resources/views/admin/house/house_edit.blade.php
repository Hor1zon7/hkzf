<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<body>
@extends('admin.common.article_common')
@section('title','房源修改')
@section('content')
    <article class="page-container">
        <form class="form form-horizontal" id="form-article-add" method="post" action="{{url("admin/fang/".$data['id'])}}">
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$data['fang_name']}}" placeholder="" id="fang_name"
                           name="fang_name">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>小区名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$data['fang_xiaoqu']}}" placeholder="" id="fang_name"
                           name="fang_xiaoqu">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>小区地址：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select name="fang_province" onchange="getCity(this,'fang_city')">
                        <option value="0">==省==</option>
                        @foreach($data['province'] as $item)
                            <option @if($item['id']==$data['fang_province']) selected
                                    @endif value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>

                    <select name="fang_city" id="fang_city" onchange="getCity(this,'fang_region')">
                        <option value="">==市==</option>
                        @foreach($data['city'] as $item)
                            <option @if($item['id']==$data['fang_city']) selected
                                    @endif value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>

                    <select name="fang_region" id="fang_region">
                        <option value="">==区/县==</option>
                        @foreach($data['region'] as $item)
                            <option @if($item['id']==$data['fang_region']) selected
                                    @endif value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源地址：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" value="{{$data['fang_addr']}}" class="input-text" name="fang_addr">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>租金：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" value="{{$data['fang_rent']}}" class="input-text" name="fang_rent">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>楼层：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" value="{{$data['fang_floor']}}" class="input-text" name="fang_floor">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>付款方式：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select name="fang_direction" id="fang_direction">
                        @foreach($relationData['fang_rent_type_data'] as $item)
                            <option @if($item['id']==$data['fang_rent_type']) selected
                                    @endif value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>几室：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" value="{{$data['fang_shi']}}" class="input-text" name="fang_shi">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>几厅：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" value="{{$data['fang_ting']}}" class="input-text" name="fang_ting">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>几卫：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" value="{{$data['fang_wei']}}" class="input-text" name="fang_wei">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>朝向：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select name="fang_direction" id="fang_direction">
                        @foreach($relationData['fang_direction_data'] as $item)
                            <option @if($item->id==$data['fang_direction']) selected
                                    @endif value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @csrf

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>租赁方式：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select name="fang_rent_class" id="fang_rent_class">
                        @foreach($relationData['fang_rent_class_data'] as $item)
                            <option @if($item->id==$data['fang_rent_class']) selected
                                    @endif value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房东：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select name="fang_owner" id="fang_owner">
                        @foreach($relationData['ownerData'] as $item)
                            <option @if($item->id==$data['fang_owner']) selected
                                    @endif value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>配套设施：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    @foreach($relationData['fang_config_data'] as $item)
                        <input type="checkbox" @if(in_array($item->id,$data['fang_config'])) checked
                               @endif name="fang_config[]" value="{{$item->id}}">
                        {{$item->name}}&nbsp;&nbsp;
                    @endforeach
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">房源照片：</label>
                <div class="imgs">
                    <input type="hidden" name="fang_pic" value="" id="pic">
                    <img src="" alt="" id="image" style="width: 100px;height: 100px;display: none">
                    @foreach($data['fang_pic'] as $item)
                        <div style='position: relative;width: 100px' class="picitem">
                            <img src='{{$item}}' alt='' style='width: 100px;height: 100px'>
                            <strong onclick="delpic(this,'{{$item}}')"
                                    style='cursor: pointer;position: absolute;right: 2px;top: 20px;color: white;font-size: 20px'>X</strong>
                        </div>
                    @endforeach
                </div>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                        {{--<button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>--}}
                    </div>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">房屋描述：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="fang_desn" class="form-control textarea" id=""></textarea>
                </div>
            </div>

            <button>提交</button>
        </form>
    </article>


    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery.validation/1.14.0/messages_zh.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/webuploader/0.1.5/webuploader.min.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/css/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/dist/webuploader.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });

            //表单验证
            $("#form-article-add").validate({
                rules: {
                    fang_name: {
                        required: true,
                    },
                    fang_xiaoqu: {
                        required: true,
                    },
                },
                onkeyup: false,
                focusCleanup: true,
                success: "valid",
                submitHandler: function (form) {
                    var index = parent.layer.getFrameIndex(window.name);
                    $(form).ajaxSubmit({
                        type: 'PUT',
                        success: function (res) {
                            parent.$('.btn-refresh').click();
                            parent.layer.close(index);
                        }
                    });


                }
            });


            $list = $("#fileList"),
                $btn = $("#btn-star"),
                state = "pending",
                uploader;

            var uploader = WebUploader.create({
                auto: true,
                swf: '{{asset(__ADMIN_LIB__)}}/webuploader/0.1.5/Uploader.swf',
                // 文件接收服务端。
                server: 'http://www.hkzf.com/admin/uploader',
                formData: {
                    "_token": "{{csrf_token()}}"
                },
                fileVal: 'swift',
                pick: {
                    id: '#filePicker',
                    multiple: true
                },
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false,
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });
            uploader.on('uploadSuccess', function (file, ret) {
                let src = ret;
                console.log(src);
                // $('#image').css('display', '');
                $('#image').attr('src', src);
                let val = $('#pic').val();
                let tmp = val + "#" + src;
                $('#pic').val(tmp);

                $('.imgs').append(`<div style='position: relative;width: 100px' class="picitem" ">
<img src='${src}' alt='' style='width: 100px;height: 100px'>
<strong onclick="delpic(this,'${src}')" style='cursor: pointer;position: absolute;right: 2px;top: 20px;color: white;font-size: 20px'>X</strong>
</div>`);
            })
            uploader.on('fileQueued', function (file) {
                var $li = $(
                        '<div id="' + file.id + '" class="item">' +
                        '<div class="pic-box"><img></div>' +
                        '<div class="info">' + file.name + '</div>' +
                        '<p class="state">等待上传...</p>' +
                        '</div>'
                    ),
                    $img = $li.find('img');
                $list.append($li);

                // 创建缩略图
                // 如果为非图片文件，可以不用调用此方法。
                // thumbnailWidth x thumbnailHeight 为 100 x 100
                // uploader.makeThumb(file, function (error, src) {
                //     if (error) {
                //         $img.replaceWith('<span>不能预览</span>');
                //         return;
                //     }
                //
                //     $img.attr('src', src);
                // }, thumbnailWidth, thumbnailHeight);
            });
            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                    $percent = $li.find('.progress-box .sr-only');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo($li).find('.sr-only');
                }
                $li.find(".state").text("上传中");
                $percent.css('width', percentage * 100 + '%');
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            // uploader.on('uploadSuccess', function (file) {
            //     $('#' + file.id).addClass('upload-state-success').find(".state").text("已上传");
            // });

            // 文件上传失败，显示上传出错。
            uploader.on('uploadError', function (file) {
                $('#' + file.id).addClass('upload-state-error').find(".state").text("上传出错");
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress-box').fadeOut();
            });
            uploader.on('all', function (type) {
                if (type === 'startUpload') {
                    state = 'uploading';
                } else if (type === 'stopUpload') {
                    state = 'paused';
                } else if (type === 'uploadFinished') {
                    state = 'done';
                }

                if (state === 'uploading') {
                    $btn.text('暂停上传');
                } else {
                    $btn.text('开始上传');
                }
            });

            $btn.on('click', function () {
                if (state === 'uploading') {
                    uploader.stop();
                } else {
                    uploader.upload();
                }
            });

            var ue = UE.getEditor('editor');
        });

        function getCity(obj, type) {
            let id = $(obj).val();
            $.ajax({
                url: 'http://www.hkzf.com/admin/getCity',
                data: {
                    id: id
                }, success: function (res) {
                    $('#' + type).html('');
                    $('#fang_region').html('');
                    $('#fang_region').html('<option value="0">=====</option>');
                    let html = `<option value="0">=======</option>`;
                    res.map(item => {
                        var {id, name} = item;
                        html += `<option value="${id}">${name}</option>`;
                    })
                    console.log(html);
                    $('#' + type).html(html);
                }
            })
        }

        function delpic(obj, src) {
            console.log(src)
            $.ajax({
                url: 'http://www.hkzf.com/admin/ownerpicDel',
                data: {
                    src: src
                },
                success: function (res) {
                    $(obj).parent('.picitem').remove();
                }
            })
        }
    </script>

    <!--/请在上方写此页面业务相关的脚本-->
@endsection
</body>

</html>
