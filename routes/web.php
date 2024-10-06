<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\employee\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth' , 'employee'])->group(function(){
    Route::get('Employee/Dashboard' , [EmployeeController::class , 'home'])->name('employee.dashboard');
    Route::post('start/{id}' , [TaskController::class , 'start'])->name('task.start');
    Route::post('end/{id}' , [TaskController::class , 'end'])->name('task.end');
});

Route::post('cancel/{id}' , [TaskController::class , 'cancel'])->name('task.cancele');

Route::get('lang/{locale}', [UserController::class , 'changeLang'])->name('changelang');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/manager.php';
