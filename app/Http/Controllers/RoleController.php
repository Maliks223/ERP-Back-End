<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all();//with('project')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->role = $request->input('role');
        $role->description = $request->input('description');

        $role->save();
        if ($role->update()) { //returns a boolean
            return response()->json([
                'role' => "Role has been created"
            ], 200);
        } else {
            return response()->json([
                'role' => 'invalid Data'
            ], 500);
        }    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return Role::find($id);
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
        $roleid = Role::find($id);
        $roleid->update(['role' => $request->input('role'),
        'description'=>$request->input('description')]);
        if ($roleid->update()) { //returns a boolean
            return response()->json([
                'role' => "Role has been created"
            ], 200);
        } else {
            return response()->json([
                'role' => 'invalid Data'
            ], 500);
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy= Role::destroy($id);
        if ($destroy) { 
            return response()->json([
                'response' => "Role has been deleted"
            ], 200);
        } else {
            return response()->json([
                'error' => 'operation failed'
            ], 500);
        }
    }
}
