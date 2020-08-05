<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\ValidateStepRequest;
use App\Models\Project;
use App\Models\Step;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a project homepage
     *
     * @param Project $project
     * @return Application|Factory|View
     */
    public function show(Project $project) {
        return view('projects.show')->with('project', $project);
    }

    /**
     * Display a form to create a new project
     *
     * @return Application|Factory|View
     */
    public function create() {
        return view('projects.create');
    }

    /**
     * Store a new project to the database
     *
     * @param CreateProjectRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateProjectRequest $request) {
        $project = Project::create($request->validated());
        $project->users()->attach(auth()->user());
        $project->save();

        return redirect(route('projects.show', ["project" => $project]));
    }

    public function submit(ValidateStepRequest $request, Project $project) {

        return redirect(route('projects.show', compact('project')));
    }
}
