<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Diagnostic;
use App\Models\Company\NeedCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DiagnosticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.diagnostics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = NeedCategory::all();

        return view('company.diagnostics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $needs_validated = $request->validate([
            'needs' => 'required|array',
        ])['needs'];

        if(auth()->guest()) {
            $request->session()->put('pending_company_diagnostic',  [
                'user_id' => null,
                'needs' => $needs_validated
            ]);

            return redirect(route('login'));
        } else {
            $diagnostic = Diagnostic::create([
                'user_id' => auth()->user()->id,
                'uuid' => uniqid()
            ]);
            $diagnostic->addNeeds($needs_validated);

            return redirect($diagnostic->path());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Diagnostic  $diagnostic
     * @return Factory|View
     */
    public function show(Diagnostic $diagnostic)
    {
        if($diagnostic->user->isNot(auth()->user())) abort(403);

        $groupedNeeds = $diagnostic->needs()->with('category')->get()->groupBy('category.name');

        return view('company.diagnostics.show', compact('diagnostic', 'groupedNeeds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Diagnostic  $diagnostic
     * @return Factory|View
     */
    public function edit(Diagnostic $diagnostic)
    {
        $categories = NeedCategory::all();
        return view('company.diagnostics.edit', compact('diagnostic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Diagnostic  $diagnostic
     * @return RedirectResponse|Redirector
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
     * @param  Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        //
    }
}
