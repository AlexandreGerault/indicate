<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        return view('projects.create');
    }

    public function store(CreateProjectRequest $request) {
        $project = Project::create($request->validated());
        $project->users()->attach(auth()->user());
        $project->save();

        return redirect(route('projects.show', ["project" => $project]));
    }
}
