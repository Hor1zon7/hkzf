<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/html5shiv.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/respond.min.js"></script>
<![endif]-->
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery-validate.js"></script>
    <link href="{{asset(__ADMIN_STATIC__)}}/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset(__ADMIN_LIB__)}}/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <title>后台登录 - H-ui.admin v3.1</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>

<input type="hidden" id="TenantId" name="TenantId" value=""/>
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        {{--      引入认证--}}
        @include('admin.common.validate')
        {{--      引入提示--}}
        @include('admin.common.msg')
        <form class="form form-horizontal" action="{{url('admin/login')}}" method="post">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="username" type="text" placeholder="账户" value="{{ old('username') }}"
                           class="input-text size-L">
                </div>
            </div>
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>
{{--            <div class="row cl">--}}
{{--                <div class="formControls col-xs-8 col-xs-offset-3">--}}
{{--                    <input class="input-text size-L" type="text" placeholder="验证码"--}}
{{--                           onblur="if(this.value==''){this.value='验证码:'}"--}}
{{--                           onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">--}}
{{--                    <img src=""> <a id="kanbuq" href="javascript:;">看不清，换一张</a></div>--}}
{{--            </div>--}}
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>


            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L"
                           value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L"
                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>

</div>

<div class="footer">Copyright TaylorSwift by H-ui.admin v3.1</div>
<script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset(__ADMIN_STATIC__)}}/h-ui/js/H-ui.min.js"></script>
<!--此乃百度统计代码，请自行删除-->
<script>
    $.validator.setDefaults({
        submitHandler: function () {
            alert("提交事件!");
        }
    });
    $('#testForm').validate({
        rules: {
            phone: {
                required: true
            }
        },
        messages: {
            phone: {
                required: '电话号要写'
            }
        },
        onkeyup: false,
        success: "valid",
        submitHandler: function (form) {
            form.submit();
        }

    })
    $().ready(function () {
        $("#commentForm").validate();
    });
</script>
<!--/此乃百度统计代码，请自行删除
</body>
</html>
