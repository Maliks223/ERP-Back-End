<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\KPI;

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

    public function kpi()
    {
        return $this->belongsToMany(KPI::class, 'kpi_id');
    }
}
