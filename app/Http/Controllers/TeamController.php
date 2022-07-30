<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Team::with('employees','projects')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = new Team();
        $team->name = $request->input('name');
        $team->save();
        if ($team->update()) { //returns a boolean
            return response()->json([
                'team' => "Team has been created"
            ], 200);
        } else {
            return response()->json([
                'team' => 'invalid Data'
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
        $team = Team::with('employees', 'projects')->get();
        $data = $team->where('id', $id);
        return $data;
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
        $teamid = Team::find($id);
        $teamid->update(['name' => $request->input('name')]);
        if ($teamid->update()) { //returns a boolean
            return response()->json([
                'team' => "Team has been updated"
            ], 200);
        } else {
            return response()->json([
                'team' => 'could not be updated'
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
        $deleteteam=Team::destroy($id);
        if ($deleteteam) { 
            return response()->json([
                'response' => "Team has been deleted"
            ], 200);
        } else {
            return response()->json([
                'error' => 'operation failed'
            ], 500);
        }
    }
}
