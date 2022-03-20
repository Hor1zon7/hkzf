<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $guarded = [
        '_token'
    ];

    public function getNode()
    {
        return $this->belongsToMany(node::class,'role_node','role_id','node_id');
    }


}
