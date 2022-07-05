<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    use HasFactory;
    protected $hidden = ['pivot'];

    protected $fillable = ['name'];

    public function team()
    {
        return $this->belongsToMany(Team::class, 'team_projects', 'Project_id', 'Team_id');
    }
}
