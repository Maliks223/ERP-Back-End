<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee_kpi;
use Carbon\Carbon;

class EmployeeKpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return employee_kpi::all();
    }
    // $roles =employeeRole::find(1)->Roles()->orderBy('id')->get();
    // return $roles;


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //validation
        $this->validate($request, [
            'rate' => 'required',
            'employee_id' => 'required',
            'lpi_id' => 'required'
        ]);


        $empKpi = new employee_kpi();
        $empKpi->employee_id = $request->input('employee_id');
        $empKpi->kpi_id = $request->input('kpi_id');
        $empKpi->rate = $request->input('rate');


        $empKpi->KPI_date = $request->input('KPI-date');
        $empKpi->save();
        return $empKpi;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee_kpi  $employeeKPI
     * @return \Illuminate\Http\Response
     */
    public function show($employeeKPI)
    {
        return employee_kpi::find($employeeKPI)::with('employees', 'kpis')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeKPI  $employeeKPI
     * @return \Illuminate\Http\Response
   


     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeKPI  $employeeKPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeKPI)
    {
        //validation
        $this->validate($request, [
            'rate' => 'required',
            'employee_id' => 'required',
            'lpi_id' => 'required'
        ]);
        var_dump($employeeKPI);
        $ekpi = employee_kpi::find($employeeKPI)->first();
        if ($ekpi) {
            $ekpi->update($request->all());
            if ($ekpi->save()) {
                return response()->json([
                    'data' => $ekpi
                ], 200);
            } else {
                return response()->json([
                    'EmployeeKPI' => 'EmployeeKPI could not be updated'
                ], 500);
            }
        }
        return response()->json([
            'EmployeeKPI' => 'EmployeeKPI could not be found'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee_kpi  $employeeKPI
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeKPI)
    {
        $ekpi = employee_kpi::find($employeeKPI)->first();
        if ($ekpi->delete()) { //returns a boolean
            return response()->json([
                'EmployeeKPI' => "kpi deleted"
            ], 200);
        } else {
            return response()->json([
                'EmployeeKPI' => 'EmployeeKPI could not be deleted'
            ], 500);
        }
    }
}
