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

Route::get('import-csv', 'ImportCsvController@read_csv');
Route::get('import_db', 'ImportCsvController@import_db');
Route::get('create_csv', 'ImportCsvController@create_csv');
