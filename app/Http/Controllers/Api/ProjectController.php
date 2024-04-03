<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fare il paginate
        $projects = Project::with('type')->with('technologies')->get();

        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function typeProjects(string $slug)
    {
        $type = Type::whereSlug($slug)->first();
        if (!$type) return response(null, 404);
        $projects = Project::whereTypeId($type->id)->with('technologies')->get();
        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }
        return response()->json(['projects' => $projects, 'label' => $type->label]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::with('type')->with('technologies')->whereSlug($slug)->first();
        if (!$project) return response(null, 404);
        if ($project->image) $project->image = url('storage/' . $project->image);
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
