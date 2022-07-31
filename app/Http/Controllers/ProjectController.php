<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::with('team')->get();
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
        $project = new project();
        $project->name = $request->input('name');

        if ($project->save()) {
            return response()->json([
                'data' => $project
            ], 200);
        } else {
            return ["Name cannot be empty"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        if ($project) {
            return response()->json([
                'data' => $project
            ], 200);
        } {
            return response()->json([
                'project' => ' could not be found'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id)->first();
        $project->update($request->all());

        if ($project->update()) { //returns a boolean
            return response()->json([
                'project' => "project has been updated"
            ], 200);
        } else {
            return response()->json([
                'project' => 'could not be updated'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $project = Project::with('team')->get()->find($id);
        if (count($project->team) > 0) {
            return response()->json([
                'error' => "can't be deleted while a Team is assigned"
            ], 500);
        } else {
            if ($project->delete()) { //returns a boolean
                return response()->json([
                    'response' => "has been deleted"
                ], 200);
            } else {
                return response()->json([
                    'error' => 'operation failed'
                ], 500);
            }
        }
    }
}
