<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    use HasFactory;
    protected $table='house';

    public function getSexAttribute($key)
    {
        if($key%2==1){
            return '男';
        }else{
            return '女';
        }
    }

}
