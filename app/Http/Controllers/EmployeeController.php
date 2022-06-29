<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $this->validate($request, [
            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:3048'
        ]);

        $employee = new Employee();
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->email = $request->input('email');
        $employee->phonenumber = $request->input('phonenumber');
        //image upload 
        $getImage = $request->image;
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->store('/images');
        $employee->image = $imageName;
        $getImage->move($imagePath, $imageName);

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
        return Employee::find($id);
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
        $this->validate($request, [
            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:3048'
        ]);
        //updating stuff with fucking image
        $post = Employee::find($id);
        $post->update([
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname'),
            "email" => $request->input('email'),
            "phonenumber" => $request->input('phonenumber'),
            "image" => $request->file('image')->move($request->image->store('/images'), $request->image->getclientoriginalname()),
            "team_id" => $request->input('team_id'),
        ]);
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $post->image = $imageName;
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
        return Employee::destroy($id);
    }
}
