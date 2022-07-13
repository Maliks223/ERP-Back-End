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
    
}






