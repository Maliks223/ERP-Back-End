<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\employee;

class Role extends Model
{
    use HasFactory;
    protected $fillable=[
        'role'
    ];

    public function employees(){
        return $this->belongsToMany(employee::class,'role_id');
    }
}
