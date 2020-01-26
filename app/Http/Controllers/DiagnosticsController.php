<?php

namespace App\Http\Controllers;

use App\Diagnostic;
use App\NeedCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class DiagnosticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('diagnostics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = NeedCategory::all();

        return view('diagnostics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $needs_validated = $request->validate([
            'needs' => 'required|array',
        ]);

        $diagnostic = Diagnostic::create([
            'user_id' => auth()->user()->id,
            'uuid' => uniqid()
        ]);
        $diagnostic->addNeeds($needs_validated['needs']);

        return redirect($diagnostic->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return Factory|View
     */
    public function show(Diagnostic $diagnostic)
    {
        if($diagnostic->user->isNot(auth()->user())) abort(403);

        $groupedNeeds = $diagnostic->needs()->with('category')->get()->groupBy('category.name');

        return view('diagnostics.show', compact('diagnostic', 'groupedNeeds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return Factory|View
     */
    public function edit(Diagnostic $diagnostic)
    {
        $categories = NeedCategory::all();
        return view('diagnostics.edit', compact('diagnostic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Diagnostic $diagnostic)
    {
        if($diagnostic->user->isNot(auth()->user())) {
            abort(403);
        }

        $validated = $request->validate([
            'needs' => 'required|array',
        ]);

        $diagnostic->needs()->detach();
        $diagnostic->addNeeds($validated['needs']);

        return redirect($diagnostic->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        //
    }
}
