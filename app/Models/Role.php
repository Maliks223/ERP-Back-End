<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    protected $fillable = ['role'];


    public function pivotproject()
    {
        return $this->hasMany(employeeRole::class, 'role_id');
    }
    public function projectop()
    {
        return $this->hasMany(Project::class)->with('projrectito');
    }
}
