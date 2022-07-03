<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KPI;
use App\Models\Employee;

class EmployeeKPI extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'kpi_id',
        'rate',
        'KPI_date'
    ];

}
