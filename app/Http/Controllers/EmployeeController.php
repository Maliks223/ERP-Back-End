<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
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
        $emplo = Employee::with('teams', 'kpis', 'roles')->get();;
        return $emplo;
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
        //validation
        $this->validate($request, [
            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:3048',
            'email'        =>  'required|email|required',
            'phonenumber'        =>  'numeric|min:8'

        ]);

        $employee = new Employee();
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->email = $request->input('email');
        $employee->phonenumber = $request->input('phonenumber');
        $employee->team_id = $request->input('team_id');

        //image upload 
        $fileName = $request->image->getClientOriginalName();
        $dateNow = Carbon::now()->toDateTimeString();
        $uniqueFileName = $dateNow . $fileName;
        $request->image->storeAs('uploads', $uniqueFileName, 'public');
        $employee->image = $uniqueFileName;

        $employee->save();
        return $employee::with('teams')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp = Employee::with('kpis')->get();
        return $emp->where('id', $id);
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
        // $this->validate($request, [
        //     'image'        =>  'image|mimes:jpeg,png,jpg,gif|max:3048',
        //     'email'        =>  'email|required',
        //     'phonenumber'  =>  'numeric|min:8'

        // ]);
        $post = Employee::find($id);
        if ($request->input('firstname')) {
            $post->firstname = $request->input('firstname');
            $post->update();
        }
        if ($request->input('lastname')) {
            $post->lastname = $request->input('lastname');
            $post->update();
        }
        if ($request->input('email')) {
            $post->email = $request->input('email');
            $post->update();
        }
        if ($request->input('phonenumber')) {
            $post->phonenumber = $request->input('phonenumber');
            $post->update();
        }
        if ($request->hasFile('image')) {
            $fileName = $request->image->getClientOriginalName();
            $dateNow = Carbon::now()->toDateTimeString();
            $uniqueFileName = $dateNow . $fileName;
            $request->image->storeAs('uploads', $uniqueFileName, 'public');
            $post->image = $uniqueFileName;
            $post->update();
        }
        if ($request->input('team_id')) {
            $post->team_id = $request->input('team_id');
            $post->update();
        }
        return response()->json([$post], 200);
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
