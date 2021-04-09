<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

// Users cannot self-register
Auth::routes(['register' => false]);

Route::redirect('/', '/show/dashboard/default');

Route::middleware(['auth'])->group(function () {
    Route::get('/clients', 'ClientsController@index');
    Route::get('/clients/detail/{sn?}', 'ClientsController@detail');
    Route::get('/clients/get_data/{serial_number?}', 'ClientsController@get_data');
    Route::get('/clients/get_links', 'ClientsController@get_links');
    Route::get('/clients/show/{which?}', 'ClientsController@show');

    Route::post('/datatables/data', 'DatatablesController@data');

    Route::get('/filter/get_filter', 'FilterController@get_filter');
    Route::post('/filter/set_filter', 'FilterController@set_filter');
    Route::get('/unit/get_machine_groups', 'UnitController@get_machine_groups');

    Route::get('/locale/get/{lang?}', 'LocaleController@get');
    Route::get('/locale/get/{lang}/{load}', 'LocaleController@get');

    Route::get('/module/{module}/{action}/{params?}', 'ModuleController@invoke')->where('params', '.*');
    Route::post('/module/{module}/{action}/{params?}', 'ModuleController@invoke')->where('params', '.*');

    Route::any('/settings/theme', 'SettingsController@theme');

    Route::get('/show', 'ShowController@index');
    Route::get('/show/custom/{which?}', 'ShowController@custom');
    Route::get('/show/dashboard/{dashboard?}', 'ShowController@dashboard');
    Route::get('/show/listing/{module}/{name?}', 'ShowController@listing');
    Route::get('/show/report/{report}/{action}', 'ShowController@report');

    Route::get('/profile', 'ProfileController@index');
    Route::get('/api/v6/me', ['uses' => 'MeController@show', 'as' => 'me.show']);
});

Route::middleware(['auth', 'can:archive'])->group(function () {
    Route::post('/archiver/update_status/{serial_number?}', 'ArchiverController@update_status');
    Route::post('/archiver/bulk_update_status', 'ArchiverController@bulk_update_status');
});

Route::middleware(['auth', 'can:delete_machine'])->group(function () {
    Route::get('/manager/delete_machine/{serial_number?}', 'ManagerController@post');
});


