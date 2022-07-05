<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
            'employee_id',
            'kpi_id'
    ];
    use HasFactory;

    // public function post()
    // {
    //     return $this->belongsTo(EmployeeKPI::class);
    // }
}
