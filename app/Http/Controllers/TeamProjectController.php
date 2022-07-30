<?php

namespace App\Http\Controllers;

use App\Models\TeamProject;
use Illuminate\Http\Request;

class TeamProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emplo = TeamProject::all();
        return $emplo;
    }

    /**
     * Show the form for creating a new resource.
     *
   

 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'Team_id' => 'required',
            'Project_id' => 'required'
        ]);
        $exists = TeamProject::where(['Team_id' => $request->input('Team_id'), 'Project_id' => $request->input('Project_id')])->get();
        if (count($exists) == 0) {
            $teamproject = new TeamProject();
            $teamproject->Team_id = $request->input('Team_id');
            $teamproject->Project_id = $request->input('Project_id');
            $teamproject->save();
            // return $teamproject;
            return response()->json([$teamproject], 200);
        }
        return response()->json(["error" => "can't bde added"], 500);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamProject  $teamProject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $teamProject = TeamProject::find($id)::all();
        if ($teamProject) {
            return response()->json([
                'Team Project' => $teamProject
            ], 200);
        } else {
            return response()->json([
                'Team Project' => 'Team Project could not be found'
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamProject  $teamProject
     * @return \Illuminate\Http\Response
     */
    public function edit($teamProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamProject  $teamProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $this->validate($request, [
            'Team_id' => 'required',
            'Project_id' => 'required'
        ]);

        $teamProject = TeamProject::find($id);
        if ($teamProject) {
            $teamProject->Team_id = $request->Team_id;
            $teamProject->Project_id = $request->Project_id;
            if ($teamProject->update()) {
                return response()->json([
                    'data' => $teamProject
                ], 200);
            } else {
                return response()->json([
                    'Team Project' => 'team project could not be updated'
                ], 500);
            }
        }
        return response()->json([
            'Team Project' => 'team project could not be found'
        ], 500);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamProject  $teamProject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $teamProject = TeamProject::find($id);
        if ($teamProject->delete()) {
            return response()->json([
                'Team project' => "has been deleted"
            ], 200);
        } else {
            return response()->json([
                'Team project' => 'could not be deleted'
            ], 500);
        }
    }
}
