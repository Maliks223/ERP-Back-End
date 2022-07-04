<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable=['name'];
    
    use HasFactory;

    // public function team()
    // {
    //     return $this->belongsToMany(Team::class,'team_projects','Team_id','Project_id');
    // }
}
