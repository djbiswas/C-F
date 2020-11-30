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

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();
Route::resource('/agents', 'App\Http\Controllers\AgentController');
Route::resource('/ie_datas', 'App\Http\Controllers\IeDataController');

Route::resource('/file_datas', 'App\Http\Controllers\FileDataController');
Route::any('/file_edit/{file_data}', 'App\Http\Controllers\FileDataController@file_edit');
Route::any('/file_list', 'App\Http\Controllers\FileDataController@file_list');

//Route::get('/expenses_report', 'Report@expenses_report')->name('expenses_report');
//Route::get('get_expenses_report', 'Report@get_expenses_report')->name('get_expenses_report');




Route::any('/receiver_report', 'App\Http\Controllers\Report@receiver_report');
Route::get('/get_receiver_report', 'App\Http\Controllers\Report@get_receiver_report')->name('get_receiver_report');

Route::any('/operator_report', 'App\Http\Controllers\Report@operator_report');
Route::get('/get_operator_report', 'App\Http\Controllers\Report@get_operator_report')->name('get_operator_report');

Route::any('/deliver_report', 'App\Http\Controllers\Report@deliver_report');

Route::get('/reports', 'App\Http\Controllers\Report@index');
Route::get('/get_all_report', 'App\Http\Controllers\Report@get_all_report')->name('get_all_report');


Route::get('/data_entry', 'App\Http\Controllers\Report@data_entry');
Route::get('/get_data_entry', 'App\Http\Controllers\Report@get_data_entry')->name('get_data_entry');


Route::get('/support', function () { return view('support'); });



Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');



