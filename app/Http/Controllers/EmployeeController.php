<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return employee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
$employee=new employee();
$employee->firstname=$request->input('firstname');
$employee->lastname=$request->input('lastname');
$employee->email=$request->input('email');
$employee->phonenumber=$request->input('phonenumber');
$employee->image=$request->file('image')->store('ERP-BACKEND/public/images');
$employee->save();
return $employee;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return employee::find($id);
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
        $post=employee::find($id);
        $post->update(["firstname"=>$request->input('firstname'),
        "lastname"=>$request->input('lastname'),
        "email"=>$request->input('email'),
        "phonenumber"=>$request->input('phonenumber'),
        "image"=>$request->file('image')->store('images'),]);
        return $post;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return employee::destroy($id);
    }
}
