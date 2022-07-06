<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class employeeProject extends Model
{
    use HasFactory;
  
    protected $fillable= [
        'employee_id',
        'project_id',
        'role_id'
    ];
    
}






