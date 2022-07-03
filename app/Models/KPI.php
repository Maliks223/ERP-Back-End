<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employee;

class KPI extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function employeeee()
    {
        return $this->belongsToMany(employee::class, 'employee_id');
    }
}
