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

use App\Models\Project;
use App\Models\Step;
use Illuminate\Support\Facades\Route;

Auth::routes();

/*
 * Static routes
 */
Route::get('/', fn() => view('welcome'))->name('landing_page');
Route::get('dashboard', 'DashboardController@index')->middleware('auth')->name('dashboard');

/*
 * Resources
 */

Route::resource('consultings', 'ConsultingsController');

Route::resource('companies', 'CompaniesController');
Route::prefix('company')
    ->name('company.')
    ->namespace('Company')
    ->group(function () {
        Route::resource('needs', 'NeedsController');
        Route::resource('need-categories', 'NeedCategoriesController');
        Route::resource('diagnostics', 'DiagnosticsController');
        Route::post('diagnostics/{diagnostic}/company/set', 'DiagnosticsController@setCompany')->name('diagnostics.set-company');
    });

Route::resource('projects', 'ProjectsController');
Route::prefix('projects')
    ->name('projects.')
    ->group(function () {
        Route::post('submit/{project}', 'ProjectsController@submit')->name('steps.submit');
    });

Route::resource('contact', 'ContactController');
