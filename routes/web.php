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

/*
 * Static routes
 */
Route::get('/', fn() => view('welcome'))->name('landing_page');
Route::get('dashboard', fn() => view('pages.authenticated.dashboard'))->name('dashboard');

/*
 * Resources
 */
Route::prefix('company')
    ->name('company.')
    ->namespace('Company')
    ->group(function () {
        Route::resource('needs', 'NeedsController');
        Route::resource('need-categories', 'NeedCategoriesController');
        Route::resource('diagnostics', 'DiagnosticsController');
    });
Route::resource('contact', 'ContactController');
