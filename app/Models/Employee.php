<?php

namespace App\Models;
use test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;


use App\Models\Role;

class employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phonenumber',
        'image',
        'team_id',
    ];


    public function teams()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    // public function Roles()
    // {
    //      return $this->belongsToMany(Role::class,'employee_roles','employee_id','role_id');
    //  }
    // public function projects()
    // {
    //     return $this->belongsTo(employeeRole::class,'project_id');
    // }

}


