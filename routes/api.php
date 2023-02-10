<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::post('/login', [AuthController::class, 'userLogin']);

Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'index');
    Route::get('/news/{id}/detail', 'show');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/logout', [AuthController::class, 'userLogout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/news', [NewsController::class, 'store']);
    Route::patch('/news/{id}/update', [NewsController::class, 'update'])->middleware('news-owner');
    Route::delete('/news/{id}/delete', [NewsController::class, 'destroy'])->middleware('news-owner');
});
