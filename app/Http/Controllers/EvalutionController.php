<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee_kpi;
use Carbon\Carbon;

class EvalutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', '2020-10-09');
        $endDate = Carbon::createFromFormat('Y-m-d', '2022-10-09');

        // $request->$startDate=$request->input('startDate');
        // $request->$endDate=$request->input('endDate');

        $employee_kpi = employee_kpi::whereBetween('KPI_date', [$startDate, $endDate])->get()->where('kpi_id', $id);
        return $employee_kpi;
    }
    // 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $s = $request->input('startDate');
        $e = $request->input('endDate');
       
        $startDate = Carbon::createFromFormat('Y-m-d',$s);
        $endDate = Carbon::createFromFormat('Y-m-d', $e);


        $employee_kpi = employee_kpi::whereBetween('KPI_date', [$startDate, $endDate])->get();
        return $employee_kpi;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)


    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
