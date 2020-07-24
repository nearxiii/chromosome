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
Route::get('export', function () {
    return view('sumary.export');
});
Route::resource('receive', 'ReceiveController');
Route::resource('amniotic', 'AmnioticController');
Route::resource('bloods', 'BloodsController');
Route::resource('sentedpcr', 'SentpcrController');
Route::resource('home', 'HomeController');
Route::resource('hospital', 'HospitalController');
Route::resource('pcr', 'QfpcrController');
Route::get('findtest', 'ReceiveController@index');
Route::get('findamniotic', 'AmnioticController@index');
Route::get('result', 'HomeController@result');
Route::get('resultamni', 'HomeController@result');
Route::post('amniotic/findno', 'AmnioticController@findlabno')->name('amniotic.findno');
Route::post('sentedpcr/store', 'SentpcrController@store')->name('sentedpcr.store');
Route::get('export/export_amni', 'HomeController@export_amni')->name('export.amniotic') ;
Route::get('export/export_blood', 'HomeController@export_blood')->name('export.blood') ;
Route::get('export/export_pcr', 'HomeController@export_pcr')->name('export.pcr') ;
Route::get('export/export_sentpcr', 'HomeController@export_sentpcr')->name('export.sentpcr') ;
Route::get('summary', 'SummaryController@labsumary');
Route::get('sumfilter', 'SummaryController@labsumary')->name('sum.filter');
Route::get('summary/export', 'SummaryController@export_view')->name('export.summary');
Route::get('monthly', 'SummaryController@monthly_sumary');
Route::get('monthlyfilter', 'SummaryController@monthly_sumary')->name('monthly.filter');
Route::get('monthly/export', 'SummaryController@export_monthly')->name('export.monthly');
Route::get('receive/update/{id}', 'ReceiveController@update_rev')->name('receive.editprofile');
Route::get('tlc', 'SummaryController@tlc_sumary');
Route::get('tlcfilter', 'SummaryController@tlc_sumary')->name('tlc.filter');
Route::get('tlc/export', 'SummaryController@export_tlc')->name('export.tlc');


