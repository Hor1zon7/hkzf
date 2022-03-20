<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class node extends Model
{
    use HasFactory;

    protected $table = 'node';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function role()
    {
        return $this->belongsToMany(role::class, 'role_node', 'role_id', 'node_id');
    }




}
