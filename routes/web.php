<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('shifts.index');
});



Route::prefix('shifts')->group(function(){
    Route::get('/', [ShiftController::class, 'index'])->name('shifts.index');
    Route::post('/', [ShiftController::class, 'store'])->name('shifts.store');
    Route::delete('/destroy/{id}', [ShiftController::class, 'destroy'])->name('shifts.destroy');
    Route::get('/show/{id}', [ShiftController::class, 'show'])->name('shifts.show');
    Route::put('/{id}', [ShiftController::class, 'update'])->name('shifts.update');
});

Route::prefix('import')->group(function(){
    Route::get('/', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import', [ImportController::class, 'store'])->name('import.import');
});

Route::prefix('employees')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('employees.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('employees.show');
});

