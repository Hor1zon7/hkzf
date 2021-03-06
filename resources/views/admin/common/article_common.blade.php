<!doctype html>
<html lang="en">
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
    <meta name="_token" content="{{ csrf_token() }}"/>
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
    {{--    js文件--}}
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_LIB__)}}/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_STATIC__)}}/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="{{asset(__ADMIN_STATIC__)}}/h-ui.admin/js/H-ui.admin.js"></script>




    <title>@yield('title')</title>
</head>
<body>

@yield('content')
</body>


</html>
