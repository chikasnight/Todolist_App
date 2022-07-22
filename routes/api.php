<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompletedTaskController;





Route::group(['middleware' =>'auth:sanctum'],function(){
    Route::post('newtask',[TodolistController::class, 'newTask']);
    Route::put('newtask',[TodolistController::class,'updateTask']);
    Route::delete('newtask/{todolistId}',[TodolistController::class,'deleteTask']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('change/password', [AuthController::class, 'changePassword']);
    
});

Route::get('completed/task/{completedTaskId}', [CompletedTaskController::class, 'getCompletedTask']);
Route::post('completed/task', [CompletedTaskController::class, 'completedTask']);
Route::delete('completed/task/{completedTaskId}', [CompletedTaskController::class, 'deleteTask']);


Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
