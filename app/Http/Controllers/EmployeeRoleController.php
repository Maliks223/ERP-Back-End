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
       $emplo= employeeRole::with('Roles','employeess','projectss')->get();
       return $emplo;
    // $roles =employeeRole::find(1)->Roles()->orderBy('id')->get();
    // return $roles;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new employeeRole();
        $role->project_id = $request->input('project_id');
        $role->employee_id = $request->input('employee_id');
        $role->role_id = $request->input('role_id');
        $role->save();
        return $role;
    }
    //; ::with('employees')->where("employee_id","=",$role->id)->get()
    /**::with('Roles')->where("role_id","=",$role->id)->get();
     * ::with('projects')->where("project_id","=",$role->id)->get()
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return employeeRole::find($id);
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
