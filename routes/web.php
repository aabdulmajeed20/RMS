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
    Route::get('edit/{id}', [
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
    Route::get('destroy/{id}', [
        'uses' => 'ReportController@destroy',
        'as' => 'destroy'
    ]);
    Route::get('deleteFile/{id}', [
        'uses' => 'ReportController@deleteFile',
        'as' => 'deleteFile'
    ]);
    Route::get('importReports', [
        'uses' => 'ReportController@importReports',
        'as' => 'importReports'
    ]);
    Route::post('importExcel', [
        'uses' => 'ReportController@importExcel',
        'as' => 'importExcel'
    ]);

});

// Route::get('/Settings', 'SettingsController@index')->name('settings');

Route::middleware(['auth', 'settings'])->prefix('Settings')->name('settings.')->group(function() {

    Route::get('/', [
        'uses' => 'SettingsController@index',
        'as' => 'index'
    ]);
    Route::prefix('Users')->name('users.')->group(function() {
        Route::get('/', [
            'uses' => 'UserController@index',
            'as' => 'index'
        ]);
        Route::get('create', [
            'uses' => 'UserController@create',
            'as' => 'create'
        ]);
        Route::get('edit/{id}', [
            'uses' => 'UserController@edit',
            'as' => 'edit'
        ]);
        Route::post('store', [
            'uses' => 'UserController@store',
            'as' => 'store'
        ]);
        Route::post('update/{id}', [
            'uses' => 'UserController@update',
            'as' => 'update'
        ]);
        Route::get('destroy/{id}', [
            'uses' => 'UserController@destroy',
            'as' => 'destroy'
        ]);
    });
    
    Route::prefix('Groups')->name('groups.')->group(function() {
        Route::get('/', [
            'uses' => 'GroupController@index',
            'as' => 'index'
        ]);
        Route::get('create', [
            'uses' => 'GroupController@create',
            'as' => 'create'
        ]);
        Route::get('edit/{id}', [
            'uses' => 'GroupController@edit',
            'as' => 'edit'
        ]);
        Route::post('store', [
            'uses' => 'GroupController@store',
            'as' => 'store'
        ]);
        Route::post('update/{id}', [
            'uses' => 'GroupController@update',
            'as' => 'update'
        ]);
        Route::get('destroy/{id}', [
            'uses' => 'GroupController@destroy',
            'as' => 'destroy'
        ]);
    });
    Route::prefix('Tags')->name('tags.')->group(function() {
        Route::get('/', [
            'uses' => 'TagController@index',
            'as' => 'index'
        ]);
        Route::get('create', [
            'uses' => 'TagController@create',
            'as' => 'create'
        ]);
        Route::get('edit/{id}', [
            'uses' => 'TagController@edit',
            'as' => 'edit'
        ]);
        Route::post('store', [
            'uses' => 'TagController@store',
            'as' => 'store'
        ]);
        Route::post('update/{id}', [
            'uses' => 'TagController@update',
            'as' => 'update'
        ]);
        Route::get('destroy/{id}', [
            'uses' => 'TagController@destroy',
            'as' => 'destroy'
        ]);
    });
});
