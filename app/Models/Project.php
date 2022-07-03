<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class Project extends Model
{

    use HasFactory;
    
    protected $fillable=['name'];



    // public function Roles(){
    //     return $this->belongsToMany(employeeRole::class);
    // }
}
