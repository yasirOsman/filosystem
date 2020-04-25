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

Route::get('/items', 'ItemController@index')->name('items.index');

Route::group(['middleware' => ['auth']], function() {
    Route::post('/items', 'ItemController@store')->name('items.store');
    Route::get('/items/create', 'ItemController@create')->name('items.create');
    Route::get('/items/{item}', 'ItemController@show')->name('items.show');
    Route::delete('/items/{item}', 'ItemController@destroy')->name('items.destroy');
    
    Route::get('/requests/create/{id}', 'RequestController@create')->name('requests.create');
    Route::post('/requests', 'RequestController@store')->name('requests.store');

    Route::group(['middleware' => 'is.admin'], function () {
        Route::get('/requests', 'RequestController@index')->name('requests.index');
        Route::delete('/requests/{request}', 'RequestController@destroy')->name('requests.destroy');
    });
});

