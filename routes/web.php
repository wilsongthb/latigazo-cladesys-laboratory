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

Route::get('/', function () {
    // return view('welcome');
    return redirect('laboratory');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('laboratory', 'Laboratory\LaboratoryViewsController@index')->middleware('auth');

Route::group(['prefix' => 'rsc'], function(){
    Route::resource('laboratory-jobs', 'Laboratory\LaboratoryJobsController');
    Route::resource('laboratory-job-types', 'Laboratory\LaboratoryJobTypesController');
    Route::post('laboratory-job-add-status', 'Laboratory\LaboratoryJobStatusController@newStatus');
});