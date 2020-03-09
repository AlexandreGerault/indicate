<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('dashboard', function() {
    return view('pages.authenticated.dashboard');
});

Route::get('/', function () {
    return view('welcome');
})->name('landing_page');

Route::resource('needs', 'NeedsController');
Route::resource('need-categories', 'NeedsController');
Route::resource('diagnostics', 'DiagnosticsController');
