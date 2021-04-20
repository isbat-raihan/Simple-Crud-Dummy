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
    return view('bank');
});



Route::get('api/bank', 'VueController@getBankData');
Route::get('api/bankac', 'VueController@getBAData');

Route::get('admin/bankac', 'VueController@Index');
Route::get('admin/bankac/data', 'VueController@getBAData');
Route::post('admin/bankac/store', 'VueController@postBAStore');
Route::post('admin/bankac/update', 'VueController@postBAUpdate');
Route::post('admin/bankac/delete', 'VueController@postBADelete');
