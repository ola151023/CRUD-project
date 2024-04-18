<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

 Route::controller(AuthController::class)->group(function () {
     Route::post('login', 'login');
     Route::post('register', 'register');
     Route::post('logout', 'logout')-> middleware('auth:api');
     Route::post('refresh', 'refresh')-> middleware('auth:api');

 });


////// Protected routes that require authentication using JWT
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::resource('task', TaskController::class);
    Route::resource('project', ProjectController::class);
});


//// Route group with auth.jwt middleware
//Route::middleware('auth.jwt')->group(function () {
//    // All routes within this group will require authentication
//    Route::resource('project', ProjectController::class)->except(['create', 'edit', 'update', 'destroy']);
//});

