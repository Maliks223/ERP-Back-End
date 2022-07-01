<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\employee;
use App\Models\Project;

class Employee_role extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'role_id',
        'project_id'
    ];
    public function employee_roles(){
       return $this->hasMany(employee::class,'employee_id',Role::class,'role_id',Project::class,'project_id');
    }
}
