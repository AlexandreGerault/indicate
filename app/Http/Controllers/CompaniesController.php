<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompaniesController extends Controller
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
     * @return Response
     */
    public function create()
    {
        if(auth()->guest()) abort(403);

        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $company = Company::create($request->validated());
        $company->users()->attach(auth()->user());
        $company->save();

        return redirect()->route('companies.show', $company);
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
     * @param  \Illuminate\Http\Request  $request
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
