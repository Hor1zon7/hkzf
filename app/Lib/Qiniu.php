<?php

namespace App\Lib;

class Qiniu
{
    public static function qiniuUpload($file,$path='hkzf/')
    {

        $disk = \Storage::disk('qiniu');

        $time = date('Y-m-d');

        $filename = $disk->put($path, $file);

        if (!$filename) {
            echo "上传失败";
        }
        $filename = config('filesystems.disks.qiniu.url') . $filename;
        return $filename;


    }
}
