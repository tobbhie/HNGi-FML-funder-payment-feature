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

Route::view('/', 'index');
Route::view('auth-header', 'auth-header');

Auth::routes();
Route::get('campaign', 'HomeController@index')->name('home');
Route::get('campaign/{id}', 'RequestController@show')->name('campaign');
Route::get('campaign/{id}/fund', 'InvestController@fund')->name('fund');
//Route::get('/home', 'HomeController@index')->name('home');
