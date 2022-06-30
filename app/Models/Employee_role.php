<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_role extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'role_id',
        'project_id'
    ];
    public function employees_roles(){

    }
}
