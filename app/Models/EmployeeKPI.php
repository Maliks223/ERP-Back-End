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

    public function employees(){
        return $this->belongsToMany(Employee::class, 'employee_k_p_i_s', 'kpi_id', 'employee_id');
    }

    public function kpis(){
        return $this->belongsToMany(KPI::class,'employee_k_p_i_s', 'employee_id', 'kpi_id');
    }

    public function reportKpi()
    {
        return $this->hasMany(Report::class);
    }
}
