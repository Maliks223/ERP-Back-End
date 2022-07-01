<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employee;
class Project extends Model
{

    use HasFactory;
    
    protected $fillable=['name'];



    public function employees(){
        return $this->belongsTo(Employee_role::class,'employee_id');
    }
}
