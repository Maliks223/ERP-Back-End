<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamProject extends Model
{
    protected $fillable = [
        'Team_id',
        'Project_id',    
    ];
    use HasFactory;

    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }

    // public function team()
    // {
    //     return $this->hasMany(Team::class);
    // }
    public function team(){
        return $this->belongsToMany(Team::class,'team_projects','Project_id','Team_id');
    }
    public function project(){
        return $this->belongsToMany(Project::class,'team_projects','Team_id','Project_id');
    }
}
