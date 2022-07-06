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

    public function Rolesi()
    {
      $this->belongsTo(employee::class,'role_id');
    }


    public function projectm()
    {
      $this->belongsTo(Project::class,'project_id');
    }


    
}






