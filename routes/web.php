<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('Report')->name('report.')->group(function() {
    Route::post('reportsJSON', [
        'uses' => 'HomeController@reportsJSON',
        'as' => 'reportsJSON'
    ]);
    Route::get('show/{id}', [
        'uses' => 'ReportController@show',
        'as' => 'show'
    ]);
    Route::get('create', [
        'uses' => 'ReportController@create',
        'as' => 'create'
    ]);
    Route::get('edit', [
        'uses' => 'ReportController@edit',
        'as' => 'edit'
    ]);
    Route::post('store', [
        'uses' => 'ReportController@store',
        'as' => 'store'
    ]);
    Route::post('update/{id}', [
        'uses' => 'ReportController@update',
        'as' => 'update'
    ]);
});
