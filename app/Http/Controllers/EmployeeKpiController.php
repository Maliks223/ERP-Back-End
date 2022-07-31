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
            'kpi_id' => 'required',
            'KPI_date' => 'required|date'
        ]);

        $empKpi = new employee_kpi();
        $empKpi->employee_id = $request->input('employee_id');
        $empKpi->kpi_id = $request->input('kpi_id');
        $empKpi->rate = $request->input('rate');
        $mydate = $request->input('KPI_date');
        $empKpi->KPI_date = Carbon::parse($mydate);
        if ($empKpi->save()) {
            return response()->json([
               'EmployeeKPI' => 'EmployeeKPI created successfully'

            ], 200);
        } else {
            return response()->json([
                'EmployeeKPI' => 'EmployeeKPI could not be created'
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee_kpi  $employeeKPI
     * @return \Illuminate\Http\Response
     */
    public function show($employeeKPI)
    {
        $employeekpi =employee_kpi::find($employeeKPI)::with('employees', 'kpis')->get();
        if ($employeekpi) { 
            return response()->json([
                'response' => $employeekpi
            ], 200);
        } else {
            return response()->json([
                'error' => 'failed to update'
            ], 500);
        }

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
            'kpi_id' => 'required'
        ]);
        $ekpi = employee_kpi::find($employeeKPI)->first();
        if ($ekpi) {
            $ekpi->update($request->all());
            if ($ekpi->save()) {
                return response()->json([
                    'data' => 'EmployeeKPI updated succesfuly'
                ], 200);
            } else {
                return response()->json([
                    'EmployeeKPI' => 'EmployeeKPI could not be updated'
                ], 500);
            }
        }
        return response()->json([
            'EmployeeKPI' => 'EmployeeKPI could not be updated'
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
