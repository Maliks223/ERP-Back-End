<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\Role;
use App\Models\Project;

use App\Models\Employee_role;

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
    public function Roles()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
    public function projects()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

}
