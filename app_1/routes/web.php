<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/user', [UserController::class, 'index']);
//Route::post('/create', [UserController::class, 'create']);
Route::controller(UserRoleController::class)->group(function () {
    Route::get('/user', 'index');
    Route::post('/create', 'create');
});

//Route::get('/role', [UserRoleController::class, 'index']);
Route::controller(UserRoleController::class)->group(function () {
    Route::get('/role','index');
});
