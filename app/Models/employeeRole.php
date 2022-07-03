<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Role;
use App\Models\Employee;

class employeeRole extends Model
{
    use HasFactory;
  
    protected $fillable= [
        'employee_id',
        'role_id',
        'project_id',
    ];
    public function Roles()
    {
         return $this->belongsToMany(Role::class,'employee_roles','employee_id','role_id','project_id');
     }
     public function employeess(){
        return $this->belongsToMany(Employee::class,'employee_roles','role_id','employee_id','project_id');
    }
    public function projectss(){
        return $this->belongsToMany(Project::class,'employee_roles','project_id','role_id','employee_id');
    }

    // public function employeeroles(){
    //    return $this->belongsToMany(Employee::class,Role::class,Project::class,'id','id','id','employee_id','role_id','project_id');
    // }
    // public function employeesss(){
    //     return $this->belongsToMany(employee::class,'employee_id','id');
    // }
    // public function rolesss(){
    //     return $this->belongsToMany(Role::class,'role_id','id');
    // }
    // public function projectsss(){
    //     return $this->belongsToMany(Project::class,'project_id','id');
    //         }
}






// class EmployeeRole extends Model
// {
//     use HasFactory;
//     protected $fillable= [
//         'employee_id',
//         'role_id',
//         'project_id',
//     ];
//     // public function employee_roles(){
//     //    return $this->hasMany(employee::class,'employee_id',Role::class,'role_id',Project::class,'project_id');
//     // }
// }
