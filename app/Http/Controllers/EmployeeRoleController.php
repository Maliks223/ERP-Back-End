<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employeeRole;

class EmployeeRoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return employeeRole::all();
    }

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
            'project_id' => 'required',
            'employee_id' => 'required',
            'role_id' => 'required'
        ]);
        $role = new employeeRole();
        $role->project_id = $request->input('project_id');
        $role->employee_id = $request->input('employee_id');
        $role->role_id = $request->input('role_id');
        $role->save();
        return $role;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = employeeRole::all();
        $record= $record->where('employee_id', $id);
        return array_values($record->toArray());
        
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
        //validation
        $this->validate($request, [
            'project_id' => 'required',
            'employee_id' => 'required',
            'role_id' => 'required'
        ]);

        $roleid = employeeRole::find($id);
        $roleid->update([
            'role_id' => $request->input('role_id'),
            'employee_id' => $request->input('employee_id'),
            'project_id' => $request->input('project_id')
        ]);
        return $roleid;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return employeeRole::destroy($id);
    }
}
