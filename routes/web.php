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
    return view('employees.index');
})->name('employees.index');
Route::get('/total-pay', function () {
    return view('employees.totalpay');
})->name('employees.totalpay');
Route::get('/import', function () {
    return view('employees.import');
})->name('employees.import');
