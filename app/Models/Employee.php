<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

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
}
