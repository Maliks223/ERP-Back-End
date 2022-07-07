<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kpi;
class employee_kpi extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'kpi_id',
        'rate',
    ];

    protected $dates =['KPI_date'];
   
    public function sikolombus(){
        return $this->belongsTo(kpi::class);
    }




}
