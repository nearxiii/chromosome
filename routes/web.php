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
Route::resource('receive', 'ReceiveController');
Route::resource('amniotic', 'AmnioticController');
Route::resource('home', 'HomeController');
Route::resource('hospital', 'HospitalController');
Route::get('findtest', 'ReceiveController@index');
Route::post('amniotic/findno', 'AmnioticController@findlabno')->name('amniotic.findno');
