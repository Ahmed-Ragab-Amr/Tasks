<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\manager\ManagerController;
use App\Http\Controllers\employee\EmployeeController;

Route::middleware(['auth' , 'admin'])->group(function(){

    Route::get('Admin/Dashboard' , [AdminController::class , 'home'])->name('admin.dashborad');

    Route::get('employee' , [EmployeeController::class , 'show'])->name('employee.show');
    Route::get('moderator' , [ManagerController::class , 'show'])->name('manager.show');

    Route::get('employee/{id}' , [AdminController::class , 'showOneEmployee'])->name('admin.employee');
    Route::get('employee/tasks/{id}' , [AdminController::class , 'showEmployeeTask'])->name('admin.tasks');

    Route::get('show/price' , [TaskController::class , 'showPrice'])->name('showPrice');
    Route::get('get/price' , [TaskController::class , 'getPrice'])->name('getPrice');

    Route::get('user' , [UserController::class , 'create'])->name('user.create');
    Route::post('user' , [UserController::class , 'store'])->name('user.store');
    Route::delete('user/{id}' , [UserController::class , 'delete'])->name('user.delete');
    Route::get('user/update/{id}' , [UserController::class , 'edit'])->name('user.edit');
    Route::put('user/update/{id}' , [UserController::class , 'update'])->name('user.update');
});
