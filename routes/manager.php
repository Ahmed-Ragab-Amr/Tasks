<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\manager\ManagerController;

Route::middleware(['auth' , 'manager'])->group(function(){

    Route::get('Manager/Dashboard' , [ManagerController::class , 'home'])->name('manager.dashboard');


    Route::get('task/create' , [TaskController::class , 'create'])->name('task.create');
    Route::get('task/update/{id}' , [TaskController::class , 'edit'])->name('task.edit');

    Route::post('task/store' , [TaskController::class , 'store'])->name('task.store');
    Route::post('task/update/{id}' , [TaskController::class , 'update'])->name('task.update');


    Route::get('all/date/tasks' , [TaskController::class , 'ShowDateTasks'])->name('manager.tasks');
    Route::get('get/tasks' , [TaskController::class , 'getTasks'])->name('manager.gettasks');
    Route::get('tasks/waiting' , [TaskController::class , 'showWaiting'])->name('task.waiting');
    Route::get('tasks/ongoing' , [TaskController::class , 'showOngoing'])->name('task.ongoing');
    Route::get('tasks/completed' , [TaskController::class , 'showCompleted'])->name('task.completed');
    Route::get('tasks/canceled' , [TaskController::class , 'showCanceled'])->name('task.canceled');
});

Route::get('show/task/{uuid}' ,[TaskController::class , 'showClientTask'])->name('client.show');
Route::post('client/task/cancele/{uuid}' , [TaskController::class , 'ClientCanceleTask'])->name('client.cancele');
