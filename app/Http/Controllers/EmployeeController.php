<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\employee_kpi;
use App\Models\kpi;

use function PHPUnit\Framework\returnSelf;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Respemployees/id=1onse
     */
    public function index()
    {
        $emplo = Employee::with('teams', 'kpis', 'roles')->get();
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
        // return $employee::with('teams')->get();
        if ($employee) { 
            return response()->json([
                'response' => "Employee created successfully"
            ], 200);
        } else {
            return response()->json([
                'error' => 'operation failed'
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $emp = Employee::with('teams', 'kpis', 'roles')->get();
        $data = $emp->where('id', $id);
        $data =  array_values($data->toArray());
        $dataObj = (object) $data[0];
        $kpis = [];
        if (count($dataObj->kpis) > 0) {
            $kpis = $dataObj->kpis;
            $kpis = array_column($kpis, 'id');
            $kpis= array_unique($kpis);
        }
        // return $kpis;
        $latest = [];
        $filtered = [];
        if ($kpis) {
            foreach ($kpis as $kpid) {
                $employeeKpi = employee_kpi::where(['employee_id' => $id, 'kpi_id' => $kpid])->orderBy('created_at', 'desc')->get()->first();
                $kpiDescription = kpi::where(["id" => $kpid])->get()->pluck("name");
                $employeeKpi->kpi_name = $kpiDescription[0];
                if ($employeeKpi) {
                    array_push($latest, $employeeKpi);
                }
            }
            foreach ($kpis as $kpid) {
                $eachKpi = employee_kpi::where(['employee_id' => $id, 'kpi_id' => $kpid])->orderBy('KPI_date', 'asc')->get();
                $kpiDescription = kpi::where(["id" => $kpid])->get()->pluck("name");
                foreach ($eachKpi as $each) {
                    $each->kpi_name = $kpiDescription[0];
                }
                if ($employeeKpi) {
                    array_push($filtered, $eachKpi);
                }
            }
        }
        return response()->json([
            'data' => $data,
            'latest_Kpi' => $latest,
            'filtered' => $filtered
        ], 200);
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
        // return response()->json([$post], 200);
        if ($post) { 
            return response()->json([
                'response' => "Employee updated successfully"
            ], 200);
        } else {
            return response()->json([
                'error' => 'operation failed'
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $destroy= Employee::destroy($id);
       if ($destroy) { 
        return response()->json([
            'response' => "Employee deleted successfully"
        ], 200);
    } else {
        return response()->json([
            'error' => 'operation failed'
        ], 500);
    }

    }
}
