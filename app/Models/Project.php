<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employee;
use App\Models\Team;

class Project extends Model
{

    use HasFactory;
    // protected $hidden = ['pivot'];

    protected $fillable = ['name'];

    public function team()
    {
        return $this->belongsToMany(Team::class, 'team_projects', 'Project_id', 'Team_id')->withPivot('id');
    }

    public function employeeso()
    {
        return $this->belongsToMany(Employee::class, 'employee_project', 'project_id', 'employee_id');
    }

    public function projrectito()
    {
        return $this->belongsTo(Role::class)->with('projectm');
    }
}
