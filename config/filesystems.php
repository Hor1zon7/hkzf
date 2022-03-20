<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'IDcard' => [
            'driver' => 'local',
            'root' => public_path('uploads/IDcard')
        ],
        'avatar' => [
            'driver' => 'local',
            'root' => public_path('uploads/avatar')
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

        'qiniu' => [
            'driver' => 'qiniu',
            'domain' => 'image.taylorswift.cloud',  //你的七牛域名
            'access_key' => 'GqTw-O6tEapJJRmrayDksBE_8v_9XrEmlyfPPiEA',    //AccessKey
            'secret_key' => 'LjiDtz-BnCu1ptUBbEk1Slp8UymUFJyve9WROXLv',   //SecretKey
            'bucket' => 'hor1zon7',    //Bucket名字，即七牛云存储空间名称
            'url'=>'http://images.taylorswift.cloud/'
        ],

        "fangattr" => [
            'driver' => 'local',
            'root' => public_path('upload/fangattr')
        ]


    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
