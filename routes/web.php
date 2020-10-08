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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('companies', 'CompaniesController');
Route::resource('employees', 'EmployeesController');

Route::get('/loaderio-7cd85db4d5a59f9bce6d58c0405d884d', function (){
   return 'loaderio-7cd85db4d5a59f9bce6d58c0405d884d';
});
