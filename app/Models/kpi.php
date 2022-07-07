<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kpi extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_kpis', 'kpi_id', 'employee_id', 'id', 'id');
    }
    public function pivotkpi(){
        return $this->hasMany(employee_kpi::class,'kpi_id');
    }
 

}
