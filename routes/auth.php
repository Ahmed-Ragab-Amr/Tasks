<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login' , [UserController::class , 'login'])->name('user.login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
