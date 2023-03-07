<?php

use App\Http\Controllers\TaskController;
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

Route::get('login', [UserController::class, 'index'])->name('login');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'registerUsers']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::resource('tasks', TaskController::class);
    Route::delete('/task/delete', [TaskController::class, 'destroy']);
    Route::put('/task/edit', [TaskController::class, 'update']);
    Route::get('logout', [UserController::class, 'logout']);
});
