<?php

namespace App\Models\admin;

use App\Models\Traits\btn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        '_token', 'password2'
    ];
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    use btn;


    public function getRole()
    {
        return $this->belongsTo(role::class, 'role_id', 'id');
    }


}
