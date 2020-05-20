<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $last_diagnostics = auth()->user()->diagnostics->take(5);
        $companies = auth()->user()->companies->take(5);

        return view('pages.authenticated.dashboard', compact('last_diagnostics', 'companies'));
    }
}
