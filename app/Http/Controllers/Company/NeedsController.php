<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Need;
use App\Models\Company\NeedCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {
        if (auth()->guest()) abort(403);

        $categories = NeedCategory::all();

        return view('need.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (auth()->guest()) abort(403);

        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric|exists:company_need_categories,id'
        ], $request->all());

        $need = Need::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
