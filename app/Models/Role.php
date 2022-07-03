<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\employee;

class Role extends Model
{
    use HasFactory;
    protected $fillable=['role'];

    public function employeess(){
        return $this->belongsToMany(employee::class,'employee_roles','employee_id','role_id');
    }
}
