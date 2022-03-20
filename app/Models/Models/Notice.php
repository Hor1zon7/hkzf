<?php

namespace App\Models\Models;

use App\Models\admin\FangOwner;
use App\Models\Traits\Base;
use App\Observers\NoticeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Base
{
    use HasFactory;
    protected $guarded=[];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::observe(NoticeObserver::class);
    }

    public function owner()
    {
        return $this->belongsTo(FangOwner::class,'fangowner_id');
    }
}
