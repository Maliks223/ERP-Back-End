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
}
