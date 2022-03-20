<?php

namespace App\Models\Traits;

use DateTimeInterface;

class Article extends Base
{
//    protected $appends=['action'];
    protected $guarded=[];

    public function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getActionAttribute()
    {
        $id= $this->id;
        return $this->editBtn("http://www.hkzf.com/admin/article/{$id}/edit",$id).'&nbsp;'.$this->deleteBtn("http://www.hkzf.com/admin/article/{$id}",$id);
    }

}
