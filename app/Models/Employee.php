<?php

namespace App\Models;

use test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\kpi;
use App\Models\Project;
use App\Models\Role;




class employee extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
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
    // public function kpis(){
    //     return $this->belongsToMany(Kpi::class,'employee_kpis','employee_id','kpi_id','id','id')->with('pivotkpi');
    // }
    public function kpis()
    {
        return $this->belongsToMany(Kpi::class, 'employee_kpis', 'employee_id', 'kpi_id', 'id', 'id');
    }
    
    // public function roles()
    // {
    //      return $this->belongsToMany(Role::class,'employee_roles','employee_id','role_id');
    //  }
     public function roles(){
        return $this->belongsToMany(Role::class,'employee_roles','project_id','role_id')->with('pivotproject');
    }
    public function employeekpi(){
        return  $this->belongsTo(employee_kpi::class,'employee_kpis');
      }
    
 

 
}
