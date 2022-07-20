<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kpi;

class KpiController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return kpi::with('employees')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $kpi = new kpi();
        $kpi->fill($request->all());
        if ($kpi->save()) {
            return response()->json([
                'data' => $kpi
            ], 200);
        } else {
            return response()->json([
                'kpi' => 'kpi could not be added'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KPI  $kPI
     * @return \Illuminate\Http\Response
     */
    public function show($kPI)
    {
        return  kpi::find($kPI);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KPI  $kPI
     * @return \Illuminate\Http\Response
     */
    public function edit(KPI $kPI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KPI  $kPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kPI)
    {
        $kpi = kpi::find($kPI)->first();
        if ($kpi) {
            $kpi->update($request->all());
            if ($kpi->save()) {
                return response()->json([
                    'data' => $kpi
                ], 200);
            } else {
                return response()->json([
                    'kpi' => 'kpi could not be updated'
                ], 500);
            }
        }
        return response()->json([
            'kpi' => 'kpi could not be found'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kpi  $kPI
     * @return \Illuminate\Http\Response
     */
    public function destroy($kPI)
    {
        $kpi = kpi::find($kPI);
        if ($kpi->delete()) { //returns a boolean
            return response()->json([
                'kpi' => "kpi deleted"
            ], 200);
        } else {
            return response()->json([
                'kpi' => 'kpi could not be deleted'
            ], 500);
        }
    }
}
