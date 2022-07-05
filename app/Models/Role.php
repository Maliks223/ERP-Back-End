<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $hidden=['pivot'];

    protected $fillable=['role'];


    public function employeess(){
        return $this->belongsToMany(Employee::class,'employee_roles','role_id','employee_id');
    }
  
}
