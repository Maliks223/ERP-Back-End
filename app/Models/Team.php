<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'team_projects', 'Team_id', 'Project_id')->withPivot('id');
    }
}
